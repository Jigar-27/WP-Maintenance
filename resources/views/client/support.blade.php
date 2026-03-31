@extends('layouts.client')
@section('title', 'Client Support')

@section('content')
<div class="card" style="max-width: 900px;">
    <h1 class="headline-md" style="margin-bottom:0.75rem;">Support</h1>
    <p class="body-md text-muted" style="margin-bottom:1.25rem;">
        Need help with billing, site issues, or account updates? Contact the concierge support team and we will respond quickly.
    </p>
    <a href="{{ route('contact') }}" class="btn btn-primary">Contact Support</a>
</div>
@endsection
