<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Client;
use App\Models\Subscription;
use App\Models\PlanFeature;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $plans = Plan::where('is_active', true)->orderBy('sort_order')->get();
        $techFeatures = PlanFeature::orderBy('sort_order')->get();

        // Dynamic stats for the trust band
        $activeClients = Client::where('status', 'active')->count();
        $activeSubs = Subscription::where('status', 'active')->count();
        $totalSitesMonitored = max($activeClients, $activeSubs, 1); // at least show 1

        return view('frontend.landing', compact('plans', 'techFeatures', 'activeClients', 'activeSubs', 'totalSitesMonitored'));
    }

    public function plans()
    {
        $plans = Plan::where('is_active', true)->orderBy('sort_order')->get();
        $techFeatures = PlanFeature::orderBy('sort_order')->get();
        return view('frontend.plans', compact('plans', 'techFeatures'));
    }


    public function faq()
    {
        return view('frontend.faq');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function privacy()
    {
        return view('frontend.privacy');
    }

    public function terms()
    {
        return view('frontend.terms');
    }

    public function disclaimer()
    {
        return view('frontend.disclaimer');
    }

    public function refund()
    {
        return view('frontend.refund');
    }

    public function sampleReport()
    {
        return view('frontend.sample-report');
    }
}
