@extends('layouts.admin')
@section('title', $client->full_name)

@section('content')
<div class="admin-header">
    <div>
        <h1 class="admin-title">{{ $client->full_name }}</h1>
        <p class="admin-subtitle">{{ $client->company_name ?? $client->email }}</p>
    </div>
    <div class="flex gap-4">
        <a href="{{ route('admin.clients.edit', $client->id) }}" class="btn btn-outline"><span class="material-icons-outlined" style="font-size:1rem">edit</span> Edit Client</a>
        <a href="{{ route('admin.clients') }}" class="btn btn-secondary">← Back</a>
    </div>
</div>

<div class="grid-2 mb-8">
    {{-- Client Info --}}
    <div class="card">
        <h3 class="title-lg mb-6">Client Information</h3>
        <div style="display:grid; gap:var(--space-4)">
            <div class="flex justify-between"><span class="body-sm text-muted">Email</span><span class="body-md">{{ $client->email }}</span></div>
            <div class="flex justify-between"><span class="body-sm text-muted">Phone</span><span class="body-md">{{ $client->phone ?? '—' }}</span></div>
            <div class="flex justify-between"><span class="body-sm text-muted">Company</span><span class="body-md">{{ $client->company_name ?? '—' }}</span></div>
            <div class="flex justify-between"><span class="body-sm text-muted">Website</span><a href="{{ $client->website_url }}" target="_blank" class="body-md">{{ $client->website_url }}</a></div>
            <div class="flex justify-between"><span class="body-sm text-muted">Status</span><span class="badge badge-{{ $client->status }}">{{ ucfirst($client->status) }}</span></div>
            <div class="flex justify-between"><span class="body-sm text-muted">Member Since</span><span class="body-md">{{ $client->created_at->format('M d, Y') }}</span></div>
        </div>
    </div>

    {{-- Billing Info --}}
    <div class="card">
        <h3 class="title-lg mb-6">Billing Details</h3>
        <div style="display:grid; gap:var(--space-4)">
            <div class="flex justify-between"><span class="body-sm text-muted">Billing Name</span><span class="body-md">{{ $client->billing_name ?? '—' }}</span></div>
            <div class="flex justify-between"><span class="body-sm text-muted">Billing Email</span><span class="body-md">{{ $client->billing_email ?? '—' }}</span></div>
            <div class="flex justify-between"><span class="body-sm text-muted">Address</span><span class="body-md">{{ $client->billing_address ?? '—' }}</span></div>
            <div class="flex justify-between"><span class="body-sm text-muted">City</span><span class="body-md">{{ $client->billing_city ?? '—' }}</span></div>
            <div class="flex justify-between"><span class="body-sm text-muted">Country</span><span class="body-md">{{ $client->billing_country ?? '—' }}</span></div>
        </div>
    </div>
</div>

{{-- Subscription History --}}
<div class="card mb-8">
    <h3 class="title-lg mb-6">Subscription History</h3>
    <div style="overflow-x:auto">
        <table class="data-table" data-yajra="1">
            <thead>
                <tr><th>Plan</th><th>Period</th><th>Amount</th><th>Status</th><th>Payment</th></tr>
            </thead>
            <tbody>
                @forelse($client->subscriptions as $sub)
                <tr>
                    <td class="title-md">{{ $sub->plan->name }}</td>
                    <td class="body-md">{{ $sub->start_date->format('M d, Y') }} — {{ $sub->end_date->format('M d, Y') }}</td>
                    <td class="title-md">${{ number_format($sub->amount, 2) }}</td>
                    <td><span class="badge badge-{{ $sub->status }}">{{ ucfirst($sub->status) }}</span></td>
                    <td><span class="badge badge-{{ $sub->payment_status }}">{{ ucfirst($sub->payment_status) }}</span></td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted">No subscriptions</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Invoices --}}
<div class="card">
    <h3 class="title-lg mb-6">Invoices</h3>
    <div style="overflow-x:auto">
        <table class="data-table" data-yajra="1">
            <thead>
                <tr><th>Invoice #</th><th>Date</th><th>Amount</th><th>Status</th><th>Action</th></tr>
            </thead>
            <tbody>
                @forelse($client->invoices as $inv)
                <tr>
                    <td class="title-md">{{ $inv->invoice_number }}</td>
                    <td class="body-md">{{ $inv->issue_date->format('M d, Y') }}</td>
                    <td class="title-md">${{ number_format($inv->total, 2) }}</td>
                    <td><span class="badge badge-{{ $inv->status }}">{{ ucfirst($inv->status) }}</span></td>
                    <td><a href="{{ route('admin.invoices.show', $inv->id) }}" class="btn btn-sm btn-outline">View</a></td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted">No invoices</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($client->notes)
<div class="card mt-8">
    <h3 class="title-lg mb-4">Notes</h3>
    <p class="body-md text-muted">{{ $client->notes }}</p>
</div>
@endif
@endsection
