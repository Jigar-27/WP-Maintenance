@extends('layouts.admin')
@section('title', 'Edit Subscription')

@section('content')
<div class="admin-header">
    <div>
        <h1 class="admin-title">Edit Subscription</h1>
        <p class="admin-subtitle">{{ $subscription->client->full_name }} — {{ $subscription->plan->name }}</p>
    </div>
    <a href="{{ route('admin.subscriptions') }}" class="btn btn-secondary">← Back</a>
</div>

<div class="card" style="max-width:600px">
    <form action="{{ route('admin.subscriptions.update', $subscription->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="form-group">
            <label class="form-label" for="plan_id">Plan</label>
            <select class="form-select" id="plan_id" name="plan_id">
                @foreach($plans as $plan)
                <option value="{{ $plan->id }}" {{ $subscription->plan_id == $plan->id ? 'selected' : '' }}>{{ $plan->name }} — ${{ number_format($plan->price, 2) }}/mo</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="form-label" for="status">Status</label>
            <select class="form-select" id="status" name="status">
                @foreach(['active','expired','cancelled','pending'] as $status)
                <option value="{{ $status }}" {{ $subscription->status === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="form-label" for="payment_status">Payment Status</label>
            <select class="form-select" id="payment_status" name="payment_status">
                @foreach(['paid','pending','failed','refunded'] as $ps)
                <option value="{{ $ps }}" {{ $subscription->payment_status === $ps ? 'selected' : '' }}>{{ ucfirst($ps) }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="form-label" for="end_date">End Date</label>
            <input type="date" class="form-input" id="end_date" name="end_date" value="{{ $subscription->end_date->format('Y-m-d') }}">
        </div>
        <button type="submit" class="btn btn-primary btn-lg mt-4">Update Subscription</button>
    </form>
</div>
@endsection
