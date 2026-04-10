@extends('layouts.frontend')
@section('title', 'Invoice ' . $invoice->invoice_number)

@push('styles')
<style>
    @media print {
        /* Hide everything first */
        body > * { display: none !important; }
        /* Then show only the main content path */
        body > main { display: block !important; }
        body > main > * { display: none !important; }
        body > main > .success-page { display: block !important; }

        /* Hide action buttons inside invoice */
        .invoice-actions { display: none !important; }

        /* Strip decoration */
        html, body { margin: 0 !important; padding: 0 !important; background: #fff !important; }
        .success-page { padding: 0 !important; margin: 0 !important; }
        .card-elevated {
            box-shadow: none !important;
            border: none !important;
            padding: 1.5rem !important;
            margin: 0 auto !important;
            max-width: 100% !important;
        }

        /* Fit on one page */
        @page { margin: 1.5cm; size: A4; }
    }
</style>
@endpush

@section('content')
<div class="success-page" style="padding: 2rem 1rem;">
    <div class="card card-elevated" style="max-width:800px; margin:0 auto; padding:2.5rem;">

        {{-- Header --}}
        <div style="display:flex; justify-content:space-between; align-items:flex-start; flex-wrap:wrap; gap:1rem; margin-bottom:2rem; border-bottom:2px solid #edf0f7; padding-bottom:1.5rem;">
            <div>
                <h2 style="font-size:1.5rem; font-weight:800; color:#1c2842; margin:0;">WP Maintenance</h2>
                <p style="color:#7b7f92; font-size:0.85rem; margin-top:0.25rem;">A product by ReUnited Technologies</p>
            </div>
            <div style="text-align:right">
                <div style="font-size:0.7rem; letter-spacing:0.1em; font-weight:900; color:#f0612f; text-transform:uppercase;">INVOICE</div>
                <div style="font-size:1.1rem; font-weight:800; color:#1c2842; margin-top:0.25rem;">{{ $invoice->invoice_number }}</div>
                <div style="font-size:0.8rem; color:#7b7f92; margin-top:0.35rem;">Issue Date: {{ $invoice->issue_date->format('M d, Y') }}</div>
                <div style="font-size:0.8rem; color:#7b7f92;">Due Date: {{ $invoice->due_date->format('M d, Y') }}</div>
            </div>
        </div>

        {{-- Bill To & Status --}}
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem; margin-bottom:2rem;">
            <div style="background:#f7f8ff; border-radius:12px; padding:1.2rem;">
                <div style="font-size:0.65rem; text-transform:uppercase; letter-spacing:0.08em; font-weight:900; color:#9da0ab; margin-bottom:0.5rem;">Bill To</div>
                <div style="font-weight:800; color:#1c2842; font-size:1rem;">{{ $invoice->client->billing_name ?? $invoice->client->full_name }}</div>
                <div style="color:#7b7f92; font-size:0.85rem;">{{ $invoice->client->billing_email ?? $invoice->client->email }}</div>
                @if($invoice->client->billing_address)
                <div style="color:#7b7f92; font-size:0.8rem; margin-top:0.5rem;">
                    {{ $invoice->client->billing_address }}<br>
                    {{ $invoice->client->billing_city }} {{ $invoice->client->billing_state }} {{ $invoice->client->billing_zip }}<br>
                    {{ $invoice->client->billing_country }}
                </div>
                @endif
            </div>
            <div style="background:#f7f8ff; border-radius:12px; padding:1.2rem;">
                <div style="font-size:0.65rem; text-transform:uppercase; letter-spacing:0.08em; font-weight:900; color:#9da0ab; margin-bottom:0.5rem;">Status</div>
                <span style="display:inline-block; padding:0.3rem 0.9rem; border-radius:999px; font-size:0.78rem; font-weight:800;
                    {{ $invoice->status === 'paid' ? 'background:#dcfce7; color:#16a34a;' : 'background:#fef3c7; color:#d97706;' }}">
                    {{ ucfirst($invoice->status) }}
                </span>
                @if($invoice->paid_date)
                <div style="color:#7b7f92; font-size:0.8rem; margin-top:0.75rem;">Paid on {{ $invoice->paid_date->format('M d, Y') }}</div>
                @endif
            </div>
        </div>

        {{-- Line Items --}}
        <table style="width:100%; border-collapse:collapse; margin-bottom:1.5rem;">
            <thead>
                <tr style="background:#f7f8ff;">
                    <th style="text-align:left; padding:0.7rem 1rem; font-size:0.65rem; text-transform:uppercase; letter-spacing:0.08em; color:#9da0ab; font-weight:900;">Description</th>
                    <th style="text-align:right; padding:0.7rem 1rem; font-size:0.65rem; text-transform:uppercase; letter-spacing:0.08em; color:#9da0ab; font-weight:900;">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom:1px solid #edf0f7;">
                    <td style="padding:1rem;">
                        <div style="font-weight:800; color:#1c2842;">{{ $invoice->subscription->plan->name ?? 'Maintenance Plan' }}</div>
                        <div style="font-size:0.8rem; color:#7b7f92;">Monthly subscription — {{ $invoice->subscription->start_date->format('M d') }} to {{ $invoice->subscription->end_date->format('M d, Y') }}</div>
                    </td>
                    <td style="text-align:right; padding:1rem; font-weight:800; color:#1c2842;">${{ number_format($invoice->subtotal, 2) }}</td>
                </tr>
            </tbody>
        </table>

        {{-- Totals --}}
        <div style="display:flex; justify-content:flex-end;">
            <table style="min-width:260px; border-collapse:collapse;">
                <tr>
                    <td style="padding:0.4rem 1rem; color:#7b7f92; font-size:0.9rem;">Subtotal</td>
                    <td style="padding:0.4rem 1rem; text-align:right; font-weight:700; color:#1c2842;">${{ number_format($invoice->subtotal, 2) }}</td>
                </tr>
                <tr>
                    <td style="padding:0.4rem 1rem; color:#7b7f92; font-size:0.9rem;">Tax (18%)</td>
                    <td style="padding:0.4rem 1rem; text-align:right; font-weight:700; color:#1c2842;">${{ number_format($invoice->tax, 2) }}</td>
                </tr>
                <tr style="border-top:2px solid #1c2842;">
                    <td style="padding:0.75rem 1rem; font-weight:900; font-size:1.1rem; color:#1c2842;">Total</td>
                    <td style="padding:0.75rem 1rem; text-align:right; font-weight:900; font-size:1.1rem; color:#f0612f;">${{ number_format($invoice->total, 2) }}</td>
                </tr>
            </table>
        </div>

        {{-- Actions --}}
        <div class="invoice-actions" style="display:flex; gap:1rem; justify-content:center; margin-top:2rem; padding-top:1.5rem; border-top:1px solid #edf0f7;">
            <button onclick="window.print()" class="btn btn-primary">
                <span class="material-icons-outlined" style="font-size:1.1rem; vertical-align:middle; margin-right:4px;">print</span>Print Invoice
            </button>
            <a href="{{ route('home') }}" class="btn btn-outline">Back to Home</a>
        </div>
    </div>
</div>
@endsection
