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
                <label class="form-label" for="status">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="active" {{ $client->status === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $client->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="suspended" {{ $client->status === 'suspended' ? 'selected' : '' }}>Suspended</option>
                </select>
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
