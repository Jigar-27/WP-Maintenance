<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReminderLog extends Model
{
    protected $fillable = [
        'subscription_id', 'client_id', 'days_before_expiry',
        'email_sent_to', 'status',
    ];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
