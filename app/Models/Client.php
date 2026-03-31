<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'company_name',
        'website_url', 'wp_admin_url', 'wp_username', 'wp_password_encrypted',
        'hosting_provider', 'hosting_login_url', 'hosting_username',
        'hosting_password_encrypted', 'sftp_host', 'sftp_username',
        'sftp_password_encrypted', 'sftp_port', 'billing_name',
        'billing_email', 'billing_address', 'billing_city', 'billing_state',
        'billing_zip', 'billing_country', 'notes', 'status',
    ];

    protected $hidden = [
        'wp_password_encrypted', 'hosting_password_encrypted', 'sftp_password_encrypted',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function activeSubscription()
    {
        return $this->hasOne(Subscription::class)->where('status', 'active')->latest();
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
