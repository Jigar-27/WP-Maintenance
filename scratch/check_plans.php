<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Plan;

$plans = Plan::all();
foreach ($plans as $plan) {
    echo "ID: {$plan->id}, Name: {$plan->name}, Price: {$plan->price}, Popular: " . ($plan->is_popular ? 'YES' : 'NO') . "\n";
}
