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
        // 1. Create Primary Administrative Account
        User::updateOrCreate(
            ['email' => 'admin@unitedwpagency.com'],
            [
                'name' => 'United WP Admin',
                'password' => Hash::make('password'), // Change this in production
                'role' => 'admin',
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        // 2. Clear existing plans and create production tiers
        Plan::truncate();
        
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
                    'Weekly Cloud Backups',
                    'Monthly Performance Reports',
                ],
                'dev_hours' => 60,
                'is_popular' => false,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'The Scaleup',
                'slug' => 'scaleup',
                'description' => 'Built for WooCommerce stores with priority development support.',
                'best_for' => 'WooCommerce Stores',
                'price' => 999.00,
                'billing_cycle' => 'monthly',
                'features' => [
                    'Advanced Security Suite',
                    'Priority Concierge Support',
                    'Daily Cloud Backups',
                    '120 hours development support',
                    'Live Monitoring Dashboard',
                ],
                'dev_hours' => 120,
                'is_popular' => true,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'The Enterprise',
                'slug' => 'enterprise',
                'description' => 'For mission-critical digital systems requiring dedicated attention.',
                'best_for' => 'Mission-Critical Systems',
                'price' => 1999.00,
                'billing_cycle' => 'monthly',
                'features' => [
                    'Dedicated Infrastructure Manager',
                    'Ecommerce Revenue Optimization',
                    'Advanced Threat Mitigation',
                    '200 hours development support',
                    'Real-time Security Response',
                ],
                'dev_hours' => 200,
                'is_popular' => false,
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}
