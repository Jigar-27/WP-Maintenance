@extends('layouts.admin')
@section('title', 'Invoice ' . $invoice->invoice_number)

@section('content')
<div class="admin-header">
    <div>
        <h1 class="admin-title">Invoice {{ $invoice->invoice_number }}</h1>
        <p class="admin-subtitle">Issued {{ $invoice->issue_date->format('F d, Y') }}</p>
    </div>
    <div class="flex gap-4">
        <button onclick="window.print()" class="btn btn-outline">
            <span class="material-icons-outlined" style="font-size:1rem">print</span> Print
        </button>
        <a href="{{ route('admin.invoices') }}" class="btn btn-secondary">← Back</a>
    </div>
</div>

<div class="card" style="max-width:800px">
    <div class="invoice-page">
        {{-- Header --}}
        <div class="invoice-header">
            <div>
                <h2 style="font-size:1.5rem; font-weight:800; color:var(--secondary-deep)">WP Maintenance</h2>
                <p class="body-sm text-muted">A product by ReUnited Technologies</p>
            </div>
            <div style="text-align:right">
                <div class="label-lg" style="color:var(--primary)">INVOICE</div>
                <div class="title-md mt-2">{{ $invoice->invoice_number }}</div>
                <div class="body-sm text-muted mt-2">Issue Date: {{ $invoice->issue_date->format('M d, Y') }}</div>
                <div class="body-sm text-muted">Due Date: {{ $invoice->due_date->format('M d, Y') }}</div>
            </div>
        </div>

        {{-- Bill To --}}
        <div class="grid-2 mb-8">
            <div class="card card-flat">
                <div class="label-md text-muted mb-2">Bill To</div>
                <div class="title-md">{{ $invoice->client->billing_name ?? $invoice->client->full_name }}</div>
                <div class="body-sm text-muted">{{ $invoice->client->billing_email ?? $invoice->client->email }}</div>
                @if($invoice->client->billing_address)
                <div class="body-sm text-muted mt-2">
                    {{ $invoice->client->billing_address }}<br>
                    {{ $invoice->client->billing_city }} {{ $invoice->client->billing_state }} {{ $invoice->client->billing_zip }}<br>
                    {{ $invoice->client->billing_country }}
                </div>
                @endif
            </div>
            <div class="card card-flat">
                <div class="label-md text-muted mb-2">Status</div>
                <span class="badge badge-{{ $invoice->status }}" style="font-size:0.875rem; padding: 0.375rem 1rem">{{ ucfirst($invoice->status) }}</span>
                @if($invoice->paid_date)
                <div class="body-sm text-muted mt-4">Paid on {{ $invoice->paid_date->format('M d, Y') }}</div>
                @endif
            </div>
        </div>

        {{-- Line Items --}}
        <table class="data-table invoice-items" data-yajra="1" style="width:100%; margin-bottom: var(--space-6)">
            <thead>
                <tr><th>Description</th><th style="text-align:right">Amount</th></tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="title-md">{{ $invoice->subscription->plan->name ?? 'Maintenance Plan' }}</div>
                        <div class="body-sm text-muted">Monthly subscription — {{ $invoice->subscription->start_date->format('M d') }} to {{ $invoice->subscription->end_date->format('M d, Y') }}</div>
                    </td>
                    <td style="text-align:right" class="title-md">${{ number_format($invoice->subtotal, 2) }}</td>
                </tr>
            </tbody>
        </table>

        {{-- Totals --}}
        <div class="invoice-total">
            <table class="invoice-total-table">
                <tr><td class="body-md text-muted">Subtotal</td><td class="title-md text-right">${{ number_format($invoice->subtotal, 2) }}</td></tr>
                <tr><td class="body-md text-muted">Tax (18%)</td><td class="title-md text-right">${{ number_format($invoice->tax, 2) }}</td></tr>
                <tr style="border-top:2px solid var(--surface-container-high)"><td class="headline-md" style="padding-top:var(--space-4)">Total</td><td class="headline-md text-right text-primary" style="padding-top:var(--space-4)">${{ number_format($invoice->total, 2) }}</td></tr>
            </table>
        </div>

        @if($invoice->notes)
        <div class="mt-8 card card-flat">
            <div class="label-md text-muted mb-2">Notes</div>
            <p class="body-md">{{ $invoice->notes }}</p>
        </div>
        @endif
    </div>
</div>
@endsection
