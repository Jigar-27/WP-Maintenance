<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanFeature extends Model
{
    protected $fillable = [
        'name',
        'description',
        'startup',
        'scaleup',
        'enterprise',
        'sort_order',
    ];

    protected $casts = [
        'startup' => 'boolean',
        'scaleup' => 'boolean',
        'enterprise' => 'boolean',
    ];
}
