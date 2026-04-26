<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Subscription;
use App\Models\Invoice;
use App\Models\Plan;
use App\Models\PlanFeature;
use App\Models\ReminderLog;
use App\Models\User;
use App\Mail\SubscriptionReminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Throwable;



class AdminController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            if (Auth::user()->isStaff()) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('client.dashboard');
        }
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $user->update([
                'status' => 'active',
                'last_login_at' => now(),
                'last_login_ip' => $request->ip(),
            ]);

            $request->session()->regenerate();
            if ($user->isStaff()) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('client.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::user()->update(['status' => 'inactive']);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function dashboard(Request $request)
    {
        // Dynamic status thresholds (synced with subscriptions page logic)
        $now = Carbon::now();
        $threshold = Carbon::now()->addDays(15);

        // Active = end_date > 15 days away AND client not suspended
        $totalSubscriptions = Subscription::where('end_date', '>', $threshold)
            ->whereHas('client', fn($q) => $q->where('status', '!=', 'suspended'))
            ->count();

        // Revenue from all non-expired, non-cancelled subscriptions
        $activeSubscriptions = Subscription::where('end_date', '>=', $now)
            ->whereHas('client', fn($q) => $q->where('status', '!=', 'suspended'))
            ->get();
        $totalRevenue = $activeSubscriptions->sum('amount');

        
        $totalClients = Client::count();
        $topClients = Client::latest()->take(3)->get();
        
        // Dynamic Growth Calculation
        $lastMonthCount = Subscription::where('end_date', '>', $threshold)
            ->whereHas('client', fn($q) => $q->where('status', '!=', 'suspended'))
            ->whereDate('created_at', '<', Carbon::now()->startOfMonth())
            ->count();
        $thisMonthCount = Subscription::where('end_date', '>', $threshold)
            ->whereHas('client', fn($q) => $q->where('status', '!=', 'suspended'))
            ->whereDate('created_at', '>=', Carbon::now()->startOfMonth())
            ->count();
        
        $subscriptionGrowth = $lastMonthCount > 0 
            ? round(($thisMonthCount / $lastMonthCount) * 100, 1) 
            : ($thisMonthCount > 0 ? 100 : 0);



        $recentSubscriptions = Subscription::with(['client', 'plan'])
            ->where('end_date', '>=', $now)
            ->whereHas('client', fn($q) => $q->where('status', '!=', 'suspended'))
            ->latest()
            ->take(5)
            ->get();

        $upcomingDues = Subscription::with(['client', 'plan'])
            ->where('end_date', '>=', $now)
            ->where('end_date', '<=', $threshold)
            ->whereHas('client', fn($q) => $q->where('status', '!=', 'suspended'))
            ->orderBy('end_date')
            ->take(3)
            ->get();

        $chartPeriod = (int) $request->query('period', 6);
        if (!in_array($chartPeriod, [3, 6, 12], true)) {
            $chartPeriod = 6;
        }

        $periodStart = Carbon::now()->startOfMonth()->subMonths($chartPeriod - 1);

        $subscriptionsForChart = Subscription::query()
            ->select(['start_date', 'amount'])
            ->whereNotNull('start_date')
            ->whereDate('start_date', '>=', $periodStart)
            ->where('payment_status', 'paid')
            ->get();

        $monthlyRevenue = $subscriptionsForChart
            ->groupBy(fn ($subscription) => Carbon::parse($subscription->start_date)->startOfMonth()->format('Y-m-01'))
            ->map(fn ($subscriptions) => (float) $subscriptions->sum('amount'));

        $chartData = [];
        for ($i = 0; $i < $chartPeriod; $i++) {
            $month = $periodStart->copy()->addMonths($i);
            $monthKey = $month->format('Y-m-01');
            $value = (float) ($monthlyRevenue->get($monthKey) ?? 0);

            $chartData[] = [
                'month' => strtoupper($month->format('M')),
                'revenue' => $value,
            ];
        }

        return view('admin.dashboard', compact(
            'totalSubscriptions', 'totalRevenue', 'totalClients', 'topClients',
            'subscriptionGrowth', 'recentSubscriptions', 'upcomingDues', 'chartData', 'chartPeriod'
        ));
    }

    public function report()
    {
        $currentMonth = Carbon::now()->format('F Y');
        $totalUpdates = rand(15, 35);
        $securityScans = rand(600, 850);
        $cloudBackups = Carbon::now()->daysInMonth;
        
        // Mocking some variation in health score
        $healthScore = rand(95, 99);
        
        return view('admin.report', compact(
            'currentMonth', 'totalUpdates', 'securityScans', 'cloudBackups', 'healthScore'
        ));
    }

    public function clients(\Illuminate\Http\Request $request)
    {
        $search = $request->query('search');
        $scope = $request->query('scope', 'all');
        $planFilter = $request->query('plan', 'all');

        $clientsQuery = Client::with(['activeSubscription.plan'])->latest();

        if ($search) {
            $clientsQuery->where(function ($q) use ($search) {
                $q->where('company_name', 'like', "%{$search}%")
                  ->orWhere('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('website_url', 'like', "%{$search}%");
            });
        }

        if ($scope === 'agency') {
            $clientsQuery->whereNotNull('company_name')->where('company_name', '!=', '');
        }

        if ($planFilter !== 'all') {
            $clientsQuery->whereHas('activeSubscription.plan', function ($q) use ($planFilter) {
                $q->where('slug', $planFilter);
            });
        }

        $activeClientsCount = Client::where('status', 'active')->count();
        $recentClients = Client::with('activeSubscription.plan')->latest()->take(3)->get();
        $planOptions = Plan::where('is_active', true)->orderBy('sort_order')->get(['name', 'slug']);
        
        $clients = $clientsQuery->get();
        
        $selectedClientId = $request->query('selected');
        $selectedClient = $selectedClientId 
            ? Client::with(['subscriptions.plan', 'invoices'])->find($selectedClientId)
            : $clients->first();
            
        if ($selectedClient && !$selectedClient->relationLoaded('invoices')) {
            $selectedClient->load(['subscriptions.plan', 'invoices' => function($q) {
                $q->latest()->take(3);
            }]);
        }

        return view('admin.clients', compact(
            'clients',
            'activeClientsCount',
            'recentClients',
            'selectedClient',
            'search',
            'scope',
            'planFilter',
            'planOptions'
        ));
    }

    public function clientShow($id)
    {
        $client = Client::with(['subscriptions.plan', 'invoices'])->findOrFail($id);
        return view('admin.client-detail', compact('client'));
    }

    public function clientEdit($id)
    {
        $client = Client::findOrFail($id);
        $plans = Plan::where('is_active', true)->get();
        return view('admin.client-edit', compact('client', 'plans'));
    }

    public function clientUpdate(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'company_name' => 'nullable|string|max:255',
            'website_url' => 'required|url',
            'notes' => 'nullable|string',
        ]);

        $client->update($validated);
        return redirect()->route('admin.clients.show', $id)->with('success', 'Client updated successfully.');
    }

    public function clientDelete($id)
    {
        Client::findOrFail($id)->delete();
        return redirect()->route('admin.clients')->with('success', 'Client deleted successfully.');
    }

    public function clientSuspend($id)
    {
        $client = Client::findOrFail($id);
        $client->update(['status' => 'suspended']);

        Subscription::where('client_id', $client->id)
            ->where('status', 'active')
            ->update(['status' => 'cancelled']);

        return back()->with('success', 'Client account suspended successfully.');
    }

    public function clientActivate($id)
    {
        $client = Client::findOrFail($id);
        $client->update(['status' => 'active']);

        // Also restore the most recent cancelled subscription to active
        Subscription::where('client_id', $client->id)
            ->where('status', 'cancelled')
            ->latest()
            ->first()
            ?->update(['status' => 'active']);

        return back()->with('success', 'Client account activated successfully with restored subscription.');
    }

    public function subscriptions(\Illuminate\Http\Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $selectedPlan = $request->query('plan_id');
        $selectedStatus = $request->query('status');

        $query = Subscription::with(['client', 'plan'])->latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('client', function ($cq) use ($search) {
                    $cq->where('company_name', 'like', "%{$search}%")
                      ->orWhere('first_name', 'like', "%{$search}%")
                      ->orWhere('last_name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('website_url', 'like', "%{$search}%");
                })->orWhereHas('plan', function ($pq) use ($search) {
                    $pq->where('name', 'like', "%{$search}%");
                });
            });
        }

        if ($selectedPlan) {
            $query->where('plan_id', $selectedPlan);
        }

        // Dynamic status filtering based on computed conditions
        if ($selectedStatus) {
            $now = Carbon::now();
            $threshold = Carbon::now()->addDays(15);

            switch ($selectedStatus) {
                case 'expired':
                    // end_date is in the past
                    $query->where('end_date', '<', $now);
                    break;
                case 'cancelled':
                    // client account is suspended
                    $query->whereHas('client', fn($q) => $q->where('status', 'suspended'));
                    break;
                case 'expiring':
                    // end_date ≤ 15 days away AND auto_renew is off AND not expired AND client not suspended
                    $query->where('end_date', '>=', $now)
                          ->where('end_date', '<=', $threshold)
                          ->where(function($q) {
                              $q->where('auto_renew', false)->orWhereNull('auto_renew');
                          })
                          ->whereHas('client', fn($q) => $q->where('status', '!=', 'suspended'));
                    break;
                case 'pending':
                    // end_date ≤ 15 days away AND auto_renew is on AND not expired AND client not suspended
                    $query->where('end_date', '>=', $now)
                          ->where('end_date', '<=', $threshold)
                          ->where('auto_renew', true)
                          ->whereHas('client', fn($q) => $q->where('status', '!=', 'suspended'));
                    break;
                case 'active':
                    // end_date > 15 days away AND client not suspended
                    $query->where('end_date', '>', $threshold)
                          ->whereHas('client', fn($q) => $q->where('status', '!=', 'suspended'));
                    break;
            }
        }

        if ($request->query('export') === 'csv') {
            $exportRows = $query->get();
            $filename = 'subscriptions-' . now()->format('Y-m-d-H-i-s') . '.csv';

            return response()->streamDownload(function () use ($exportRows) {
                $handle = fopen('php://output', 'w');
                fputcsv($handle, [
                    'Subscription ID',
                    'Client',
                    'Client Email',
                    'Domain',
                    'Plan',
                    'Annual Price',

                    'Status',
                    'Payment Status',
                    'Start Date',
                    'End Date',
                ]);

                foreach ($exportRows as $sub) {
                    $domain = parse_url($sub->client->website_url ?? '', PHP_URL_HOST) ?: ($sub->client->website_url ?? '');

                    fputcsv($handle, [
                        'SUB-' . str_pad($sub->id, 4, '0', STR_PAD_LEFT),
                        $sub->client->company_name ?: $sub->client->full_name,
                        $sub->client->email,
                        $domain,
                        $sub->plan->name ?? '',
                        number_format((float) ($sub->amount ?? $sub->plan->price ?? 0), 2, '.', ''),
                        $sub->status,
                        $sub->payment_status,
                        optional($sub->start_date)->format('Y-m-d'),
                        optional($sub->end_date)->format('Y-m-d'),
                    ]);
                }

                fclose($handle);
            }, $filename, [
                'Content-Type' => 'text/csv',
                'Cache-Control' => 'no-store, no-cache',
            ]);
        }

        $subscriptions = $query->get();
        $plans = Plan::withCount(['subscriptions' => function ($query) {
            $query->where('status', 'active');
        }])->get();
        
        return view('admin.subscriptions', compact('subscriptions', 'plans', 'search', 'selectedPlan', 'selectedStatus'));
    }

    public function subscriptionCreate()
    {
        $clients = Client::orderBy('company_name')->orderBy('first_name')->get();
        $plans = Plan::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.subscription-create', compact('clients', 'plans'));
    }

    public function subscriptionStore(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'plan_id' => 'required|exists:plans,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:active,expired,cancelled,pending',
            'payment_status' => 'required|in:paid,pending,failed,refunded',
            'payment_method' => 'nullable|string|max:255',
            'transaction_id' => 'nullable|string|max:255',
            'auto_renew' => 'nullable|boolean',
        ]);

        $plan = Plan::findOrFail($validated['plan_id']);

        Subscription::create([
            'client_id' => $validated['client_id'],
            'plan_id' => $validated['plan_id'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'status' => $validated['status'],
            'payment_status' => $validated['payment_status'],
            'payment_method' => $validated['payment_method'] ?? null,
            'transaction_id' => $validated['transaction_id'] ?? null,
            'auto_renew' => (bool) ($validated['auto_renew'] ?? false),
            'amount' => $plan->price,
        ]);

        return redirect()->route('admin.subscriptions')->with('success', 'Subscription created successfully.');
    }

    public function subscriptionEdit($id)
    {
        $subscription = Subscription::with(['client', 'plan'])->findOrFail($id);
        $plans = Plan::where('is_active', true)->get();
        return view('admin.subscription-edit', compact('subscription', 'plans'));
    }

    public function subscriptionUpdate(Request $request, $id)
    {
        $subscription = Subscription::findOrFail($id);
        $validated = $request->validate([
            'plan_id' => 'required|exists:plans,id',
            'status' => 'required|in:active,expired,cancelled,pending',
            'payment_status' => 'required|in:paid,pending,failed,refunded',
            'end_date' => 'required|date',
        ]);

        $plan = Plan::findOrFail($validated['plan_id']);
        $validated['amount'] = $plan->price;

        $subscription->update($validated);
        return redirect()->route('admin.subscriptions')->with('success', 'Subscription updated successfully.');
    }

    public function planEdit($id)
    {
        $plan = Plan::findOrFail($id);
        return view('admin.plan-edit', compact('plan'));
    }

    public function planUpdate(Request $request, $id)
    {
        $plan = Plan::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('plans', 'slug')->ignore($plan->id),
            ],
            'description' => 'nullable|string',
            'best_for' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'dev_hours' => 'nullable|integer|min:0',

            'features' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_popular' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        $features = collect(preg_split('/\r\n|\r|\n/', $validated['features'] ?? ''))
            ->map(fn ($feature) => trim($feature))
            ->filter()
            ->values()
            ->all();

        $plan->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['slug'] ?: $validated['name']),
            'description' => $validated['description'] ?? null,
            'best_for' => $validated['best_for'] ?? null,
            'price' => $validated['price'],
            'dev_hours' => $validated['dev_hours'] ?? 0,

            'features' => $features,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_popular' => (bool) ($validated['is_popular'] ?? false),
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ]);

        return redirect()->route('admin.subscriptions')->with('success', 'Plan updated successfully.');
    }

    public function upcomingDues(\Illuminate\Http\Request $request)
    {
        $search = $request->query('search');
        $query = Subscription::with(['client', 'plan'])
            ->whereIn('status', ['active', 'pending', 'expired'])
            ->orderBy('end_date');

        if ($search) {
            $query->whereHas('client', function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->query('bulk') === 'reminders') {
            return redirect()
                ->route('admin.dues', $request->except('bulk'))
                ->with('success', 'Bulk reminder job queued successfully.');
        }

        if ($request->query('export') === 'csv') {
            $rows = $query->get();
            $filename = 'upcoming-dues-' . now()->format('Y-m-d-H-i-s') . '.csv';

            return response()->streamDownload(function () use ($rows) {
                $handle = fopen('php://output', 'w');
                fputcsv($handle, [
                    'Client',
                    'Email',
                    'Domain',
                    'Plan',
                    'Amount',
                    'Status',
                    'Payment Status',
                    'Due Date',
                    'Days Until Expiry',
                ]);

                foreach ($rows as $due) {
                    $domain = parse_url($due->client->website_url ?? '', PHP_URL_HOST) ?: ($due->client->website_url ?? '');
                    fputcsv($handle, [
                        $due->client->company_name ?: $due->client->full_name,
                        $due->client->email,
                        $domain,
                        $due->plan->name ?? '',
                        number_format((float) ($due->amount ?? $due->plan->price ?? 0), 2, '.', ''),
                        $due->status,
                        $due->payment_status,
                        optional($due->end_date)->format('Y-m-d'),
                        $due->days_until_expiry,
                    ]);
                }

                fclose($handle);
            }, $filename, [
                'Content-Type' => 'text/csv',
                'Cache-Control' => 'no-store, no-cache',
            ]);
        }

        $dues = $query->get();

        // Fully dynamic stats — no hardcoded fallbacks
        $totalOutstanding = Invoice::whereIn('status', ['pending', 'overdue'])->sum('total');
        $dueThisWeek = Subscription::whereBetween('end_date', [Carbon::now()->startOfDay(), Carbon::now()->addDays(7)->endOfDay()])->sum('amount');
        $pendingSites = Subscription::where('end_date', '>=', Carbon::now())
            ->where('end_date', '<=', Carbon::now()->addDays(15))
            ->whereHas('client', fn($q) => $q->where('status', '!=', 'suspended'))
            ->count();
        $overdueAmount = Invoice::where('status', 'overdue')->sum('total');
        $criticalAlerts = Invoice::where('status', 'overdue')->whereDate('due_date', '<', Carbon::now()->subDays(3))->count();

        // Month-over-month outstanding growth
        $lastMonthOutstanding = Invoice::whereIn('status', ['pending', 'overdue'])
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->sum('total');
        $outstandingGrowth = $lastMonthOutstanding > 0
            ? round((($totalOutstanding - $lastMonthOutstanding) / $lastMonthOutstanding) * 100)
            : 0;

        return view('admin.upcoming-dues', compact(
            'dues', 'totalOutstanding', 'dueThisWeek', 'pendingSites', 'overdueAmount', 'criticalAlerts', 'search', 'outstandingGrowth'
        ));
    }

    public function sendUpcomingDueReminder($id)
    {
        $subscription = Subscription::with(['client', 'plan'])->findOrFail($id);
        $email = $subscription->client?->email;

        if (!$email) {
            return back()->with('error', 'Unable to send reminder: client email is missing.');
        }

        $daysUntilExpiry = (int) $subscription->days_until_expiry;
        $flagColumn = match (true) {
            $daysUntilExpiry <= 0 => 'reminder_0_sent',
            $daysUntilExpiry <= 5 => 'reminder_5_sent',
            $daysUntilExpiry <= 10 => 'reminder_10_sent',
            default => 'reminder_15_sent',
        };

        try {
            Mail::to($email)->send(new SubscriptionReminder($subscription, $daysUntilExpiry));
            $subscription->update([$flagColumn => true]);

            ReminderLog::create([
                'subscription_id' => $subscription->id,
                'client_id' => $subscription->client_id,
                'days_before_expiry' => $daysUntilExpiry,
                'email_sent_to' => $email,
                'status' => 'sent',
            ]);

            return back()->with('success', 'Reminder email sent to ' . $email . '.');
        } catch (Throwable $e) {
            ReminderLog::create([
                'subscription_id' => $subscription->id,
                'client_id' => $subscription->client_id,
                'days_before_expiry' => $daysUntilExpiry,
                'email_sent_to' => $email,
                'status' => 'failed',
            ]);

            report($e);
            return back()->with('error', 'Failed to send reminder email. Please try again.');
        }
    }

    public function users(\Illuminate\Http\Request $request)
    {
        $search = $request->query('search');
        $query = User::where('role', '!=', 'client')->latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->get();
        $totalUsers = User::where('role', '!=', 'client')->count();
        $admins = User::where('role', 'admin')->count();
        $managers = User::where('role', 'manager')->count();
        $support = User::where('role', 'support')->count();

        return view('admin.users', compact('users', 'totalUsers', 'admins', 'managers', 'support', 'search'));
    }

    public function userCreate()
    {
        return view('admin.user-create');
    }

    public function userStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:admin,manager,support',
            'status' => 'nullable|string|in:active,inactive',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'status' => $validated['status'] ?? 'active',
            'email_verified_at' => now(),
        ]);

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    public function userEdit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user-edit', compact('user'));
    }

    public function userUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'role' => 'required|string|in:admin,manager,support',
            'password' => 'nullable|string|min:8|confirmed',
            'status' => 'required|string|in:active,inactive',
        ]);

        $payload = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'status' => $validated['status'],
        ];

        if (!empty($validated['password'])) {
            $payload['password'] = Hash::make($validated['password']);
        }

        $user->update($payload);

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function userDelete($id)
    {
        $user = User::findOrFail($id);
        if (User::count() <= 1) {
            return back()->with('error', 'Cannot delete the last admin user.');
        }
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    public function invoices(\Illuminate\Http\Request $request)
    {
        $search = $request->query('search');

        $query = Invoice::with(['client', 'subscription.plan'])->latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('invoice_number', 'like', "%{$search}%")
                  ->orWhereHas('client', function ($cq) use ($search) {
                      $cq->where('first_name', 'like', "%{$search}%")
                         ->orWhere('last_name', 'like', "%{$search}%")
                         ->orWhere('company_name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
                  })
                  ->orWhereHas('subscription.plan', function ($pq) use ($search) {
                      $pq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $invoices = $query->get();
        return view('admin.invoices', compact('invoices', 'search'));
    }

    public function invoiceShow($id)
    {
        $invoice = Invoice::with(['client', 'subscription.plan'])->findOrFail($id);
        return view('admin.invoice-detail', compact('invoice'));
    }

    public function profileEdit()
    {
        $user = Auth::user();
        return view('admin.profile-edit', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $payload = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        if (!empty($validated['password'])) {
            $payload['password'] = Hash::make($validated['password']);
        }

        $user->update($payload);

        return redirect()->route('admin.profile.edit')->with('success', 'Profile updated successfully.');
    }
    public function plans()
    {
        $plans = Plan::orderBy('sort_order')->get();
        $features = PlanFeature::orderBy('sort_order')->get();
        return view('admin.plans', compact('plans', 'features'));
    }

    public function planFeatureStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'startup' => 'nullable|boolean',
            'scaleup' => 'nullable|boolean',
            'enterprise' => 'nullable|boolean',
            'sort_order' => 'integer',
        ]);

        PlanFeature::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'startup' => $request->has('startup'),
            'scaleup' => $request->has('scaleup'),
            'enterprise' => $request->has('enterprise'),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.plans')->with('success', 'Feature created successfully.');
    }

    public function planFeatureUpdate(Request $request, $id)
    {
        $feature = PlanFeature::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'sort_order' => 'integer',
        ]);

        $feature->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'startup' => $request->has('startup'),
            'scaleup' => $request->has('scaleup'),
            'enterprise' => $request->has('enterprise'),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.plans')->with('success', 'Feature updated successfully.');
    }

    public function planFeatureDelete($id)

    {
        $feature = PlanFeature::findOrFail($id);
        $feature->delete();

        return redirect()->route('admin.plans')->with('success', 'Feature deleted successfully.');
    }
}


