@extends('layouts.admin')
@section('title', 'Settings')

@section('content')
<div class="admin-header">
    <div>
        <h1 class="admin-title">Settings</h1>
        <p class="admin-subtitle">Configure your Agency Console preferences</p>
    </div>
</div>

<div class="grid-2">
    <div class="card">
        <h3 class="title-lg mb-6">General Settings</h3>
        <div class="form-group">
            <label class="form-label">Company Name</label>
            <input type="text" class="form-input" value="WP Maintenance" disabled>
        </div>
        <div class="form-group">
            <label class="form-label">Support Email</label>
            <input type="email" class="form-input" value="support@wpmaintenance.com" disabled>
        </div>
        <div class="form-group">
            <label class="form-label">Timezone</label>
            <input type="text" class="form-input" value="Asia/Kolkata (IST)" disabled>
        </div>
        <div class="alert alert-info">
            <span class="material-icons-outlined">info</span>
            Settings management is available in a future update. Contact your system administrator to make changes.
        </div>
    </div>

    <div class="card">
        <h3 class="title-lg mb-6">Email Notifications</h3>
        <div style="display:flex; flex-direction:column; gap:var(--space-4)">
            <label style="display:flex; align-items:center; gap:var(--space-3); padding:var(--space-3); background:var(--surface-container-low); border-radius:var(--radius-md); cursor:pointer">
                <input type="checkbox" checked disabled style="accent-color:var(--primary)">
                <div>
                    <div class="title-md">New Client Notifications</div>
                    <div class="body-sm text-muted">Receive an email when a new client subscribes</div>
                </div>
            </label>
            <label style="display:flex; align-items:center; gap:var(--space-3); padding:var(--space-3); background:var(--surface-container-low); border-radius:var(--radius-md); cursor:pointer">
                <input type="checkbox" checked disabled style="accent-color:var(--primary)">
                <div>
                    <div class="title-md">Subscription Reminders</div>
                    <div class="body-sm text-muted">Automated reminders at 15, 10, 5, and 0 days before expiry</div>
                </div>
            </label>
            <label style="display:flex; align-items:center; gap:var(--space-3); padding:var(--space-3); background:var(--surface-container-low); border-radius:var(--radius-md); cursor:pointer">
                <input type="checkbox" checked disabled style="accent-color:var(--primary)">
                <div>
                    <div class="title-md">Invoice Emails</div>
                    <div class="body-sm text-muted">Send invoices automatically after payment</div>
                </div>
            </label>
        </div>
    </div>
</div>

<div class="card mt-8">
    <h3 class="title-lg mb-6">Scheduled Tasks</h3>
    <div style="overflow-x:auto">
        <table class="data-table" data-yajra="1">
            <thead><tr><th>Task</th><th>Schedule</th><th>Description</th><th>Status</th></tr></thead>
            <tbody>
                <tr>
                    <td class="title-md">subscriptions:send-reminders</td>
                    <td class="body-md">Daily at 9:00 AM</td>
                    <td class="body-sm text-muted">Sends expiry reminder emails at 15, 10, 5, and 0 days</td>
                    <td><span class="badge badge-active">Active</span></td>
                </tr>
                <tr>
                    <td class="title-md">subscriptions:cleanup-expired</td>
                    <td class="body-md">Daily at midnight</td>
                    <td class="body-sm text-muted">Marks expired subscriptions and deletes old data after 30 days</td>
                    <td><span class="badge badge-active">Active</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
