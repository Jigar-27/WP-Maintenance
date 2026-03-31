<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Subscription extends Model
{
    protected $fillable = [
        'client_id', 'plan_id', 'start_date', 'end_date', 'amount',
        'status', 'payment_status', 'payment_method', 'transaction_id',
        'auto_renew', 'reminder_15_sent', 'reminder_10_sent',
        'reminder_5_sent', 'reminder_0_sent',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'amount' => 'decimal:2',
        'auto_renew' => 'boolean',
        'reminder_15_sent' => 'boolean',
        'reminder_10_sent' => 'boolean',
        'reminder_5_sent' => 'boolean',
        'reminder_0_sent' => 'boolean',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function reminderLogs()
    {
        return $this->hasMany(ReminderLog::class);
    }

    public function getDaysUntilExpiryAttribute()
    {
        return Carbon::now()->diffInDays($this->end_date, false);
    }

    public function getIsExpiredAttribute()
    {
        return $this->end_date->isPast();
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeExpiringSoon($query, $days = 15)
    {
        return $query->where('status', 'active')
            ->where('end_date', '<=', Carbon::now()->addDays($days))
            ->where('end_date', '>=', Carbon::now());
    }

    public function scopeExpired($query)
    {
        return $query->where('status', 'active')
            ->where('end_date', '<', Carbon::now());
    }
}
