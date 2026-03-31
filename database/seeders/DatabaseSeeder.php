<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\User;
use App\Models\Client;
use App\Models\Subscription;
use App\Models\Invoice;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Agency Admin',
            'email' => 'admin@wpmaintenance.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Agency Manager',
            'email' => 'manager@wpmaintenance.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Agency Support',
            'email' => 'support@wpmaintenance.com',
            'password' => Hash::make('password'),
            'role' => 'support',
            'email_verified_at' => now(),
        ]);

        // Create Plans
        $plans = [
            [
                'name' => 'The Startup',
                'slug' => 'startup',
                'description' => 'Perfect for informative websites that need reliable maintenance.',
                'best_for' => 'Informative Websites',
                'price' => 499.00,
                'billing_cycle' => 'monthly',
                'features' => [
                    'Standard Maintenance',
                    'Basic Security',
                    'Uptime Monitoring',
                    '60 hours development support',
                    'Monthly reports',
                ],
                'dev_hours' => 60,
                'is_popular' => false,
                'sort_order' => 1,
            ],
            [
                'name' => 'The Scaleup',
                'slug' => 'scaleup',
                'description' => 'Built for WooCommerce stores with priority support.',
                'best_for' => 'WooCommerce Stores',
                'price' => 999.00,
                'billing_cycle' => 'monthly',
                'features' => [
                    'All features of The Startup',
                    'Priority Support',
                    'Daily Backups',
                    '120 hours development support',
                    'Monthly reports',
                ],
                'dev_hours' => 120,
                'is_popular' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'The Enterprise',
                'slug' => 'enterprise',
                'description' => 'For mission-critical systems requiring dedicated attention.',
                'best_for' => 'Mission-Critical Systems',
                'price' => 1999.00,
                'billing_cycle' => 'monthly',
                'features' => [
                    'All features of The Scaleup',
                    'Ecommerce Optimization',
                    'Dedicated Manager',
                    '200 hours development support',
                    'Monthly reports',
                ],
                'dev_hours' => 200,
                'is_popular' => false,
                'sort_order' => 3,
            ],
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }

        // Create Demo Clients
        $demoClients = [
            ['first_name' => 'Demo', 'last_name' => 'Client', 'email' => 'client@wpmaintenance.com', 'company_name' => 'Demo Client Co', 'website_url' => 'https://democlient.wpmaintenance.com', 'status' => 'active'],
            ['first_name' => 'Marcus', 'last_name' => 'Chen', 'email' => 'marcus@globalventure.io', 'company_name' => 'Global Venture', 'website_url' => 'https://globalventure.io', 'status' => 'active'],
            ['first_name' => 'Sarah', 'last_name' => 'Mitchell', 'email' => 'sarah@zenithdesign.co', 'company_name' => 'Zenith Design', 'website_url' => 'https://zenithdesign.co', 'status' => 'active'],
            ['first_name' => 'James', 'last_name' => 'Rodriguez', 'email' => 'james@pixelperfect.dev', 'company_name' => 'Pixel Perfect', 'website_url' => 'https://pixelperfect.dev', 'status' => 'active'],
            ['first_name' => 'Aisha', 'last_name' => 'Patel', 'email' => 'aisha@novatech.com', 'company_name' => 'Nova Tech', 'website_url' => 'https://novatech.com', 'status' => 'active'],
            ['first_name' => 'David', 'last_name' => 'Kim', 'email' => 'david@brightweb.io', 'company_name' => 'BrightWeb', 'website_url' => 'https://brightweb.io', 'status' => 'active'],
        ];

        foreach ($demoClients as $index => $clientData) {
            $client = Client::create($clientData);

            $planSlug = ['startup', 'startup', 'scaleup', 'enterprise', 'scaleup', 'startup'][$index];
            $plan = Plan::where('slug', $planSlug)->first();

            $daysOffset = [7, 4, 12, 19, 45, 90][$index];

            $subscription = Subscription::create([
                'client_id' => $client->id,
                'plan_id' => $plan->id,
                'start_date' => Carbon::now()->subMonths(rand(3, 12)),
                'end_date' => Carbon::now()->addDays($daysOffset),
                'amount' => $plan->price,
                'status' => 'active',
                'payment_status' => 'paid',
                'payment_method' => 'stripe',
                'transaction_id' => 'txn_' . strtolower(str()->random(16)),
            ]);

            Invoice::create([
                'invoice_number' => Invoice::generateInvoiceNumber(),
                'client_id' => $client->id,
                'subscription_id' => $subscription->id,
                'subtotal' => $plan->price,
                'tax' => round($plan->price * 0.18, 2),
                'total' => round($plan->price * 1.18, 2),
                'status' => 'paid',
                'issue_date' => $subscription->start_date,
                'due_date' => $subscription->start_date->copy()->addDays(7),
                'paid_date' => $subscription->start_date,
            ]);

            User::firstOrCreate(
                ['email' => $client->email],
                [
                    'name' => trim(($client->first_name ?? '') . ' ' . ($client->last_name ?? '')) ?: ($client->company_name ?: 'Client User'),
                    'password' => Hash::make('password'),
                    'role' => 'client',
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}
