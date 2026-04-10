<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'best_for', 'price',
        'quarterly_discount', 'yearly_discount',
        'billing_cycle', 'features', 'dev_hours', 'is_popular',
        'is_active', 'sort_order',
    ];

    protected $casts = [
        'features' => 'array',
        'price' => 'decimal:2',
        'quarterly_discount' => 'decimal:2',
        'yearly_discount' => 'decimal:2',
        'is_popular' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    protected static function booted(): void
    {
        static::saved(function (Plan $plan) {
            if (!$plan->is_popular) {
                return;
            }

            // Enforce a single "most popular" plan across the system.
            static::whereKeyNot($plan->id)->update(['is_popular' => false]);
        });
    }
}
