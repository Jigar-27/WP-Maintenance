@extends('layouts.admin')
@section('title', 'Edit User')

@section('content')
<div class="admin-header">
    <div>
        <h1 class="admin-title">Edit User</h1>
        <p class="admin-subtitle">{{ $user->name }} — {{ $user->email }}</p>
    </div>
    <a href="{{ route('admin.users') }}" class="btn btn-secondary">← Back</a>
</div>

<div class="card" style="max-width:780px">
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-grid">
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

            <div class="form-group">
                <label class="form-label" for="role">Role *</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="manager" {{ old('role', $user->role) === 'manager' ? 'selected' : '' }}>Manager</option>
                    <option value="support" {{ old('role', $user->role) === 'support' ? 'selected' : '' }}>Support</option>
                </select>
                @error('role') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password">New Password (optional)</label>
                <input type="password" class="form-input" id="password" name="password" minlength="8">
                @error('password') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password_confirmation">Confirm New Password</label>
                <input type="password" class="form-input" id="password_confirmation" name="password_confirmation" minlength="8">
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-lg mt-4">Update User</button>
    </form>
</div>
@endsection
