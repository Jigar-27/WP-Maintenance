@extends('layouts.admin')
@section('title', 'Edit Plan')

@section('content')
<div class="admin-header">
    <div>
        <h1 class="admin-title">Edit Plan</h1>
        <p class="admin-subtitle">{{ $plan->name }}</p>
    </div>
    <a href="{{ route('admin.subscriptions') }}" class="btn btn-secondary">← Back</a>
</div>

<div class="card" style="max-width:900px">
    <form action="{{ route('admin.plans.update', $plan->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label" for="name">Plan Name *</label>
                <input type="text" class="form-input" id="name" name="name" value="{{ old('name', $plan->name) }}" required>
                @error('name') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="slug">Slug</label>
                <input type="text" class="form-input" id="slug" name="slug" value="{{ old('slug', $plan->slug) }}" placeholder="auto-generated from name if blank">
                @error('slug') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="price">Price *</label>
                <input type="number" step="0.01" min="0" class="form-input" id="price" name="price" value="{{ old('price', $plan->price) }}" required>
                @error('price') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="billing_cycle">Billing Cycle *</label>
                <select class="form-select" id="billing_cycle" name="billing_cycle" required>
                    @foreach(['monthly' => 'Monthly', 'quarterly' => 'Quarterly', 'yearly' => 'Yearly'] as $key => $label)
                        <option value="{{ $key }}" {{ old('billing_cycle', $plan->billing_cycle) === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @error('billing_cycle') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="best_for">Best For</label>
                <input type="text" class="form-input" id="best_for" name="best_for" value="{{ old('best_for', $plan->best_for) }}">
                @error('best_for') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="dev_hours">Dev Hours</label>
                <input type="number" min="0" class="form-input" id="dev_hours" name="dev_hours" value="{{ old('dev_hours', $plan->dev_hours) }}">
                @error('dev_hours') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="sort_order">Sort Order</label>
                <input type="number" min="0" class="form-input" id="sort_order" name="sort_order" value="{{ old('sort_order', $plan->sort_order) }}">
                @error('sort_order') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" style="display:block;">Flags</label>
                <div style="display:flex; gap:1rem; margin-top:0.5rem; align-items:center; flex-wrap:wrap;">
                    <label style="display:inline-flex; gap:0.4rem; align-items:center;">
                        <input type="checkbox" name="is_popular" value="1" {{ old('is_popular', $plan->is_popular) ? 'checked' : '' }}>
                        <span>Most Popular</span>
                    </label>
                    <label style="display:inline-flex; gap:0.4rem; align-items:center;">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $plan->is_active) ? 'checked' : '' }}>
                        <span>Active</span>
                    </label>
                </div>
                @error('is_popular') <div class="form-error">{{ $message }}</div> @enderror
                @error('is_active') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group form-full">
                <label class="form-label" for="description">Description</label>
                <textarea class="form-textarea" id="description" name="description">{{ old('description', $plan->description) }}</textarea>
                @error('description') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group form-full">
                <label class="form-label" for="features">Features (one per line)</label>
                <textarea class="form-textarea" id="features" name="features" placeholder="Feature A&#10;Feature B&#10;Feature C">{{ old('features', is_array($plan->features) ? implode("\n", $plan->features) : '') }}</textarea>
                @error('features') <div class="form-error">{{ $message }}</div> @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-lg mt-4">Update Plan</button>
    </form>
</div>
@endsection
