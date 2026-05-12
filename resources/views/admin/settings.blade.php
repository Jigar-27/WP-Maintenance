@extends('layouts.admin')

@section('title', 'System Settings')

@section('content')
<div class="admin-header">
    <div>
        <h1 class="admin-title">System Settings</h1>
        <p class="admin-subtitle">Manage global configuration for your platform.</p>
    </div>
</div>

<div class="card" style="max-width: 760px;">
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label class="form-label" for="support_email">Support Email Address *</label>
            <input type="email" class="form-input" id="support_email" name="support_email" value="{{ old('support_email', $supportEmail) }}" required placeholder="support@yourdomain.com">
            <p style="font-size: 0.875rem; color: #64748b; margin-top: 6px;">This email will be displayed on the frontend and used as the default contact email.</p>
            @error('support_email') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div style="display:flex; gap: var(--space-3); margin-top: var(--space-6);">
            <button type="submit" class="btn btn-primary">Save Settings</button>
        </div>
    </form>
</div>
@endsection
