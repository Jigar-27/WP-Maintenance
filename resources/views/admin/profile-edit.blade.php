@extends('layouts.admin')
@section('title', 'Edit Profile')

@section('content')
<div class="admin-header">
    <div>
        <h1 class="admin-title">Edit Profile</h1>
        <p class="admin-subtitle">Update your account details and password.</p>
    </div>
</div>

<div class="card" style="max-width: 760px;">
    <form action="{{ route('admin.profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label" for="name">Full Name *</label>
            <input type="text" class="form-input" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            @error('name') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="email">Email *</label>
            <input type="email" class="form-input" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div style="margin: 2.5rem 0 1.5rem; border-top: 1px solid #f1f5f9; padding-top: 2rem;">
            <h3 style="font-size: 1.125rem; font-weight: 800; color: var(--cp-dark); display: flex; align-items: center; gap: 8px;">
                <span class="material-icons-outlined" style="color: var(--cp-primary);">shield</span>
                Account Security
            </h3>
            <p style="font-size: 0.875rem; color: #64748b; margin-top: 4px;">Leave fields blank if you do not wish to change your password.</p>
        </div>

        <div class="grid-2">
            <div class="form-group">
                <label class="form-label" for="password">New Password</label>
                <input type="password" class="form-input" id="password" name="password" minlength="8" placeholder="••••••••">
                @error('password') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-input" id="password_confirmation" name="password_confirmation" minlength="8">
            </div>
        </div>

        <div style="display:flex; gap: var(--space-3); margin-top: var(--space-6);">
            <button type="submit" class="btn btn-primary">Save Profile</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
