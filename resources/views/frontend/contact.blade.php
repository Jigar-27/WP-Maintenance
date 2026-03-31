@extends('layouts.frontend')

@section('title', 'Contact Us')
@section('meta_description', 'Get in touch with our WordPress maintenance team. We are here to help you with any questions.')

@section('content')
<section class="section" style="padding-top: calc(var(--space-20) + 80px)">
    <div class="container" style="max-width: 900px">
        <div class="text-center mb-8" data-animate>
            <h1 class="display-md">Get in Touch</h1>
            <p class="body-lg text-muted mt-4" style="max-width:500px; margin: var(--space-4) auto 0">Have a question about our services? Our concierge team is here to assist you.</p>
        </div>

        <div class="grid-2" data-animate>
            <div>
                <div class="card" style="height:100%">
                    <h3 class="headline-md mb-6">Send a Message</h3>
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="name">Full Name *</label>
                            <input type="text" class="form-input" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name') <div class="form-error">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email">Email Address *</label>
                            <input type="email" class="form-input" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email') <div class="form-error">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="subject">Subject</label>
                            <input type="text" class="form-input" id="subject" name="subject" value="{{ old('subject') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="message">Message *</label>
                            <textarea class="form-textarea" id="message" name="message" required>{{ old('message') }}</textarea>
                            @error('message') <div class="form-error">{{ $message }}</div> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Send Message</button>
                    </form>
                </div>
            </div>

            <div>
                <div class="card card-flat mb-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="stat-icon orange">
                            <span class="material-icons-outlined">mail</span>
                        </div>
                        <div>
                            <div class="title-md">Email Us</div>
                            <div class="body-md text-muted">support@wpmaintenance.com</div>
                        </div>
                    </div>
                </div>
                <div class="card card-flat mb-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="stat-icon blue">
                            <span class="material-icons-outlined">schedule</span>
                        </div>
                        <div>
                            <div class="title-md">Business Hours</div>
                            <div class="body-md text-muted">Mon — Fri, 9:00 AM — 6:00 PM IST</div>
                        </div>
                    </div>
                </div>
                <div class="card card-flat">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="stat-icon green">
                            <span class="material-icons-outlined">support_agent</span>
                        </div>
                        <div>
                            <div class="title-md">Emergency Support</div>
                            <div class="body-md text-muted">Enterprise clients: 24/7 critical support</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
