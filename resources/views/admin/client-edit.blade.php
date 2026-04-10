@extends('layouts.admin')
@section('title', 'Edit Client')

@section('content')
<div class="admin-header">
    <div>
        <h1 class="admin-title">Edit Client</h1>
        <p class="admin-subtitle">{{ $client->full_name }}</p>
    </div>
    <a href="{{ route('admin.clients.show', $client->id) }}" class="btn btn-secondary">← Back</a>
</div>

<div class="card" style="max-width:800px">
    <form action="{{ route('admin.clients.update', $client->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label" for="first_name">First Name *</label>
                <input type="text" class="form-input" id="first_name" name="first_name" value="{{ old('first_name', $client->first_name) }}" required>
                @error('first_name') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="last_name">Last Name *</label>
                <input type="text" class="form-input" id="last_name" name="last_name" value="{{ old('last_name', $client->last_name) }}" required>
                @error('last_name') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="email">Email Address *</label>
                <input type="email" class="form-input" id="email" name="email" value="{{ old('email', $client->email) }}" required>
                @error('email') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="phone">Phone</label>
                <input type="tel" class="form-input" id="phone" name="phone" value="{{ old('phone', $client->phone) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="company_name">Company Name</label>
                <input type="text" class="form-input" id="company_name" name="company_name" value="{{ old('company_name', $client->company_name) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="website_url">Website URL *</label>
                <input type="url" class="form-input" id="website_url" name="website_url" value="{{ old('website_url', $client->website_url) }}" required>
                @error('website_url') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Status</label>
                @php
                    $statusColor = match($client->status) {
                        'active' => '#16a34a',
                        'inactive' => '#b45309',
                        'suspended' => '#dc2626',
                        default => '#64748b',
                    };
                    $statusLabel = ucfirst($client->status);
                @endphp
                <div style="display: flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1rem; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px;">
                    <span style="width: 8px; height: 8px; border-radius: 50%; background: {{ $statusColor }};"></span>
                    <span style="font-weight: 700; font-size: 0.9375rem; color: {{ $statusColor }};">{{ $statusLabel }}</span>
                </div>
                <div style="margin-top: 0.5rem; font-size: 0.8125rem; color: #94a3b8; line-height: 1.5;">
                    Status is managed via Suspend / Activate actions on the client detail page.
                </div>
            </div>
            <div class="form-group form-full">
                <label class="form-label" for="notes">Notes</label>
                <textarea class="form-textarea" id="notes" name="notes">{{ old('notes', $client->notes) }}</textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-lg mt-4">Update Client</button>
    </form>
</div>

@endsection
