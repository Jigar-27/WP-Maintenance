@extends('layouts.admin')
@section('title', 'Add Subscription')

@section('content')
<div class="admin-header">
    <div>
        <h1 class="admin-title">Add Subscription</h1>
        <p class="admin-subtitle">Create a new client subscription and assign a plan.</p>
    </div>
    <a href="{{ route('admin.subscriptions') }}" class="btn btn-secondary">← Back</a>
</div>

<div class="card" style="max-width:800px">
    <form action="{{ route('admin.subscriptions.store') }}" method="POST">
        @csrf
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label" for="client_id">Client *</label>
                <select class="form-select" id="client_id" name="client_id" required>
                    <option value="">Select client</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ (string) old('client_id') === (string) $client->id ? 'selected' : '' }}>
                            {{ $client->company_name ?: $client->full_name }} ({{ $client->email }})
                        </option>
                    @endforeach
                </select>
                @error('client_id') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="plan_id">Plan *</label>
                <select class="form-select" id="plan_id" name="plan_id" required>
                    <option value="">Select plan</option>
                    @foreach($plans as $plan)
                        <option value="{{ $plan->id }}" {{ (string) old('plan_id') === (string) $plan->id ? 'selected' : '' }}>
                            {{ $plan->name }} — ${{ number_format($plan->price * 12, 2) }}/yr
                        </option>
                    @endforeach
                </select>
                @error('plan_id') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="start_date">Start Date *</label>
                <input type="date" class="form-input" id="start_date" name="start_date" value="{{ old('start_date', now()->format('Y-m-d')) }}" required>
                @error('start_date') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="end_date">End Date *</label>
                <input type="date" class="form-input" id="end_date" name="end_date" value="{{ old('end_date', now()->addYear()->format('Y-m-d')) }}" required>
                @error('end_date') <div class="form-error">{{ $message }}</div> @enderror
            </div>


            <div class="form-group">
                <label class="form-label" for="status">Status *</label>
                <select class="form-select" id="status" name="status" required>
                    @foreach(['active' => 'Active', 'pending' => 'Pending', 'expired' => 'Expired', 'cancelled' => 'Cancelled'] as $key => $label)
                        <option value="{{ $key }}" {{ old('status', 'active') === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @error('status') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="payment_status">Payment Status *</label>
                <select class="form-select" id="payment_status" name="payment_status" required>
                    @foreach(['paid' => 'Paid', 'pending' => 'Pending', 'failed' => 'Failed', 'refunded' => 'Refunded'] as $key => $label)
                        <option value="{{ $key }}" {{ old('payment_status', 'pending') === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @error('payment_status') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="payment_method">Payment Method</label>
                <input type="text" class="form-input" id="payment_method" name="payment_method" value="{{ old('payment_method') }}" placeholder="e.g. stripe">
                @error('payment_method') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="transaction_id">Transaction ID</label>
                <input type="text" class="form-input" id="transaction_id" name="transaction_id" value="{{ old('transaction_id') }}">
                @error('transaction_id') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group" style="display:flex; align-items:center; gap:0.5rem; padding-top:1.85rem;">
                <input type="checkbox" id="auto_renew" name="auto_renew" value="1" {{ old('auto_renew', '1') ? 'checked' : '' }}>
                <label class="form-label" for="auto_renew" style="margin:0;">Enable Auto Renew</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-lg mt-4">Create Subscription</button>
    </form>
</div>
@endsection
