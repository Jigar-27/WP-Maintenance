@extends('layouts.client')
@section('title', 'Client Settings')

@section('content')
<div class="card" style="max-width: 900px;">
    <h1 class="headline-md" style="margin-bottom:0.75rem;">Settings</h1>
    <p class="body-md text-muted" style="margin-bottom:1.25rem;">
        Client settings are managed by your account team. Use support to request billing, access, or notification changes.
    </p>
    <a href="{{ route('client.support') }}" class="btn btn-primary">Open Support</a>
</div>
@endsection
