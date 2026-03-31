<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'invoice_number', 'client_id', 'subscription_id',
        'subtotal', 'tax', 'total', 'status',
        'issue_date', 'due_date', 'paid_date', 'notes',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax' => 'decimal:2',
        'total' => 'decimal:2',
        'issue_date' => 'date',
        'due_date' => 'date',
        'paid_date' => 'date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public static function generateInvoiceNumber()
    {
        $prefix = 'INV-' . date('Ym') . '-';
        $lastInvoice = self::where('invoice_number', 'like', $prefix . '%')
            ->orderBy('invoice_number', 'desc')->first();

        if ($lastInvoice) {
            $lastNum = intval(substr($lastInvoice->invoice_number, strlen($prefix)));
            return $prefix . str_pad($lastNum + 1, 4, '0', STR_PAD_LEFT);
        }

        return $prefix . '0001';
    }
}
