<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PlanFeature;

class PlanFeatureSeeder extends Seeder
{
    public function run(): void
    {
        $features = [
            ['name' => 'Core Updates', 'description' => 'WordPress core, themes, and plugins', 'startup' => true, 'scaleup' => true, 'enterprise' => true, 'sort_order' => 1],
            ['name' => 'Safe Staging', 'description' => 'Tested in staging before production', 'startup' => true, 'scaleup' => true, 'enterprise' => true, 'sort_order' => 2],
            ['name' => 'WAF (Web Application Firewall)', 'description' => 'Enterprise-grade protection', 'startup' => false, 'scaleup' => true, 'enterprise' => true, 'sort_order' => 3],
            ['name' => 'PHP Optimization', 'description' => 'Custom PHP configurations', 'startup' => false, 'scaleup' => true, 'enterprise' => true, 'sort_order' => 4],
            ['name' => 'Visual Regression Testing', 'description' => 'Screenshot comparison testing', 'startup' => false, 'scaleup' => false, 'enterprise' => true, 'sort_order' => 5],
        ];

        foreach ($features as $feature) {
            PlanFeature::create($feature);
        }
    }
}
