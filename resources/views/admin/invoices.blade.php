@extends('layouts.admin')
@section('title', 'Invoices')

@section('content')
<div class="admin-header">
    <div>
        <h1 class="admin-title">All Invoices</h1>
        <p class="admin-subtitle">
            @if($search ?? false)
                Showing results for <strong>"{{ $search }}"</strong> —
                <a href="{{ route('admin.invoices') }}" style="color: var(--primary); font-weight:600;">Clear search</a>
            @else
                Complete billing history
            @endif
        </p>
    </div>
</div>

<div id="search-results-region">
<div class="card">
    <div style="overflow-x:auto">
        <table class="data-table" data-yajra="1">
            <thead>
                <tr><th>Invoice #</th><th>Client</th><th>Plan</th><th>Amount</th><th>Date</th><th>Status</th><th>Action</th></tr>
            </thead>
            <tbody>
                @forelse($invoices as $inv)
                <tr>
                    <td class="title-md">{{ $inv->invoice_number }}</td>
                    <td>
                        <div class="title-md">{{ $inv->client->full_name }}</div>
                        <div class="body-sm text-muted">{{ $inv->client->company_name }}</div>
                    </td>
                    <td>{{ $inv->subscription->plan->name ?? '—' }}</td>
                    <td class="title-md">${{ number_format($inv->total, 2) }}</td>
                    <td class="body-sm">{{ $inv->issue_date->format('M d, Y') }}</td>
                    <td><span class="badge badge-{{ $inv->status }}">{{ ucfirst($inv->status) }}</span></td>
                    <td><a href="{{ route('admin.invoices.show', $inv->id) }}" class="btn btn-sm btn-outline">View</a></td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted" style="padding:var(--space-10)">
                        @if($search ?? false)
                            No invoices found matching <strong>"{{ $search }}"</strong>
                        @else
                            No invoices found
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination yajra-table-footer"></div>
</div>
</div>
@endsection
