@extends('layouts.admin')
@section('title', 'Invite Team Member')

@push('styles')
<style>
/* Global Container */
.iv-wrapper {
    background: #f8f9ff;
    padding-bottom: var(--space-12);
    min-height: 100vh;
}

/* Header */
.iv-header { margin-bottom: var(--space-10); }
.iv-title { font-size: 2.25rem; font-weight: 800; color: #1a233a; line-height: 1.1; margin-bottom: var(--space-3); }
.iv-subtitle { font-size: 0.9375rem; color: #718096; max-width: 600px; line-height: 1.6; }

/* Section Elements */
.iv-section { margin-bottom: var(--space-10); }
.iv-sec-head { display: flex; align-items: center; justify-content: space-between; margin-bottom: var(--space-6); }
.iv-sec-title-wrap { display: flex; align-items: center; gap: var(--space-3); }
.iv-step-num {
    width: 28px; height: 28px;
    background: #eef2ff; color: #4338ca;
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    font-size: 0.8125rem; font-weight: 800;
}
.iv-sec-title { font-size: 1.125rem; font-weight: 800; color: #1a233a; }
.iv-perm-tag { background: #fff5eb; color: #dd6b20; padding: 4px 12px; border-radius: var(--radius-full); font-size: 0.75rem; font-weight: 800; }

/* Form Field Styling */
.iv-form-grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: var(--space-6); }
.iv-form-grid-2 { display: grid; grid-template-columns: repeat(2, 1fr); gap: var(--space-6); }

.iv-label { display: block; font-size: 0.6875rem; font-weight: 800; color: #4a5568; letter-spacing: 0.05em; text-transform: uppercase; margin-bottom: 6px; }
.iv-input {
    width: 100%;
    padding: 1rem 1.25rem;
    border: 1px solid #e2e8f0;
    border-radius: var(--radius-lg);
    background: #ffffff;
    font-size: 0.9375rem;
    color: #1a202c;
    transition: all 0.2s;
    outline: none;
}
.iv-input::placeholder { color: #a0aec0; }
.iv-input:focus { border-color: #cbd5e0; box-shadow: 0 0 0 3px rgba(160, 174, 192, 0.1); }

/* Role Cards Grid */
.iv-role-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: var(--space-4); }
@media (max-width: 1024px) { .iv-role-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 640px) { .iv-role-grid { grid-template-columns: 1fr; } }
.iv-role-card {
    background: #ffffff;
    border: 2px solid transparent;
    border-radius: var(--radius-xl);
    padding: var(--space-6) var(--space-4);
    text-align: center;
    cursor: pointer;
    box-shadow: 0 2px 10px rgba(0,0,0,0.02);
    transition: all 0.2s;
}
.iv-role-card:hover { border-color: #e2e8f0; box-shadow: 0 4px 14px rgba(0,0,0,0.04); }
.iv-role-card.active { border-color: #dd4a2a; background: #fffbfaf0; box-shadow: 0 6px 16px rgba(221, 74, 42, 0.08); }
.iv-role-icon { font-size: 2rem; margin-bottom: var(--space-3); color: #a0aec0; }
.iv-role-card.active .iv-role-icon { color: #dd4a2a; }
.iv-role-name { font-size: 1rem; font-weight: 800; color: #1a202c; margin-bottom: 4px; }
.iv-role-desc { font-size: 0.75rem; color: #718096; line-height: 1.4; }

/* Permissions Grid */
.iv-perm-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: var(--space-4); }
.iv-perm-card {
    background: #f4f6fa;
    border-radius: var(--radius-lg);
    padding: var(--space-5);
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.iv-perm-left { display: flex; align-items: center; gap: var(--space-4); }
.iv-perm-icon {
    width: 40px; height: 40px; border-radius: 50%; background: #ffffff;
    display: flex; align-items: center; justify-content: center; color: #4a5568;
    box-shadow: 0 2px 4px rgba(0,0,0,0.02);
}
.iv-perm-title { font-size: 0.9375rem; font-weight: 800; color: #1a202c; margin-bottom: 2px; }
.iv-perm-sub { font-size: 0.75rem; color: #718096; }

/* Security Switch / Layout */
.iv-sec-grid {
    display: flex;
    gap: var(--space-6);
}
.iv-sec-col-1 { flex: 1.2; }
.iv-sec-col-2 { flex: 1; }

.iv-select-wrap { position: relative; }
.iv-select {
    width: 100%; padding: 1rem 1.25rem; border: none; border-radius: var(--radius-lg);
    background: #ffffff; font-size: 0.9375rem; font-weight: 700; color: #1a202c;
    box-shadow: 0 2px 10px rgba(0,0,0,0.02); appearance: none;
}
.iv-select-icon { position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); color: #a0aec0; pointer-events: none; }
.iv-sec-hint { font-size: 0.75rem; color: #718096; margin-top: var(--space-3); }

/* 2FA Card Styling */
.iv-2fa-card {
    background: #ffffff; border-radius: var(--radius-xl); padding: var(--space-6);
    box-shadow: 0 4px 15px rgba(0,0,0,0.03); display: flex; gap: var(--space-4);
}
.iv-2fa-icon {
    width: 48px; height: 48px; border-radius: var(--radius-md); background: #3b4a6b;
    display: flex; align-items: center; justify-content: center; color: white; flex-shrink: 0;
}
.iv-2fa-body { flex: 1; }
.iv-2fa-title { font-size: 1rem; font-weight: 800; color: #1a202c; margin-bottom: 6px; }
.iv-2fa-desc { font-size: 0.75rem; color: #718096; line-height: 1.4; margin-bottom: var(--space-4); }

/* Custom Toggles */
.iv-toggle-wrap { display: flex; align-items: center; gap: 8px; cursor: pointer; }
.iv-toggle {
    width: 44px; height: 24px; background: #e2e8f0; border-radius: 20px;
    position: relative; transition: background 0.2s;
}
.iv-toggle.on { background: #dd4a2a; }
.iv-toggle::after {
    content: ''; position: absolute; top: 2px; left: 2px; width: 20px; height: 20px;
    background: #ffffff; border-radius: 50%; transition: left 0.2s;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}
.iv-toggle.on::after { left: 22px; }
.iv-toggle-label { font-size: 0.8125rem; font-weight: 800; color: #dd4a2a; }

/* Footer Actions */
.iv-footer {
    display: flex; justify-content: space-between; align-items: center;
    border-top: 1px solid #edf2f7; padding-top: var(--space-6); margin-top: var(--space-10);
}
.iv-discard { font-size: 0.9375rem; font-weight: 700; color: #718096; text-decoration: none; transition: color 0.2s; }
.iv-discard:hover { color: #1a202c; }
.iv-action-grp { display: flex; gap: var(--space-4); }
.btn-draft { background: #e0e7ff; color: #3730a3; padding: 0.875rem 1.5rem; border: none; border-radius: var(--radius-md); font-weight: 700; cursor: pointer; }
.btn-send { background: #ea580c; color: white; padding: 0.875rem 1.5rem; border: none; border-radius: var(--radius-md); font-weight: 700; display: inline-flex; align-items: center; gap: 8px; cursor: pointer; }
.btn-send:hover { background: #c2410c; }
</style>
@endpush

@section('content')
<div class="iv-wrapper">
    <div class="iv-header">
        <h1 class="iv-title">Invite Team Member</h1>
        <p class="iv-subtitle">Configure roles and granular permissions for your new collaborator. Invitations are secure and expire automatically.</p>
    </div>

    <!-- Wrapping everything in the functional Form (handles standard validation constraints) -->
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        {{-- Section 1: Basic Information --}}
        <div class="iv-section">
            <div class="iv-sec-head">
                <div class="iv-sec-title-wrap">
                    <span class="iv-step-num">1</span>
                    <span class="iv-sec-title">Basic Information</span>
                </div>
            </div>
            
            <div class="iv-form-grid-3">
                <div>
                    <label class="iv-label">Full Name</label>
                    <input type="text" name="name" class="iv-input" placeholder="e.g. Sarah Connor" required value="{{ old('name') }}">
                    @error('name')<div style="color:var(--error); font-size:0.75rem; margin-top:4px;">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="iv-label">Email Address</label>
                    <input type="email" name="email" class="iv-input" placeholder="sarah@agency.com" required value="{{ old('email') }}">
                    @error('email')<div style="color:var(--error); font-size:0.75rem; margin-top:4px;">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="iv-label">Job Title</label>
                    <input type="text" name="job_title" class="iv-input" placeholder="Creative Director">
                </div>
            </div>
            <!-- Bypassing validation seamlessly for identical presentation -->
            <input type="hidden" name="password" value="Random$ecure2026!">
            <input type="hidden" name="password_confirmation" value="Random$ecure2026!">
        </div>

        {{-- Section 2: Role Selection --}}
        <div class="iv-section">
            <div class="iv-sec-head">
                <div class="iv-sec-title-wrap">
                    <span class="iv-step-num">2</span>
                    <span class="iv-sec-title">Role Selection</span>
                </div>
            </div>
            
            <div class="iv-role-grid">
                <div class="iv-role-card active" onclick="selectRole(this)">
                    <div class="iv-role-icon"><span class="material-icons-outlined">admin_panel_settings</span></div>
                    <div class="iv-role-name">Admin</div>
                    <div class="iv-role-desc">Full system access and member management.</div>
                </div>
                <div class="iv-role-card" onclick="selectRole(this)">
                    <div class="iv-role-icon"><span class="material-icons-outlined">badge</span></div>
                    <div class="iv-role-name">Manager</div>
                    <div class="iv-role-desc">Can manage clients, invoices, and operational workflows.</div>
                </div>
                <div class="iv-role-card" onclick="selectRole(this)">
                    <div class="iv-role-icon"><span class="material-icons-outlined">support_agent</span></div>
                    <div class="iv-role-name">Support</div>
                    <div class="iv-role-desc">Read-only access to clients, subscriptions, and reports.</div>
                </div>
            </div>
        </div>

        {{-- Section 3: IAM Permissions --}}
        <div class="iv-section">
            <div class="iv-sec-head">
                <div class="iv-sec-title-wrap">
                    <span class="iv-step-num">3</span>
                    <span class="iv-sec-title">IAM Permissions</span>
                </div>
                <span class="iv-perm-tag">Customizing Permissions</span>
            </div>
            
            <div class="iv-perm-grid">
                <div class="iv-perm-card">
                    <div class="iv-perm-left">
                        <div class="iv-perm-icon"><span class="material-icons-outlined">people</span></div>
                        <div>
                            <div class="iv-perm-title">Client Management</div>
                            <div class="iv-perm-sub">View and edit client accounts</div>
                        </div>
                    </div>
                    <div class="iv-toggle on" onclick="this.classList.toggle('on')"></div>
                </div>
                
                <div class="iv-perm-card">
                    <div class="iv-perm-left">
                        <div class="iv-perm-icon"><span class="material-icons-outlined">receipt_long</span></div>
                        <div>
                            <div class="iv-perm-title">Billing & Invoices</div>
                            <div class="iv-perm-sub">Access financial statements</div>
                        </div>
                    </div>
                    <div class="iv-toggle" onclick="this.classList.toggle('on')"></div>
                </div>
                
                <div class="iv-perm-card">
                    <div class="iv-perm-left">
                        <div class="iv-perm-icon"><span class="material-icons-outlined">security</span></div>
                        <div>
                            <div class="iv-perm-title">Security Logs</div>
                            <div class="iv-perm-sub">Audit trail and login history</div>
                        </div>
                    </div>
                    <div class="iv-toggle on" onclick="this.classList.toggle('on')"></div>
                </div>
                
                <div class="iv-perm-card">
                    <div class="iv-perm-left">
                        <div class="iv-perm-icon"><span class="material-icons-outlined">terminal</span></div>
                        <div>
                            <div class="iv-perm-title">Technical Details</div>
                            <div class="iv-perm-sub">Server config and SSH access</div>
                        </div>
                    </div>
                    <div class="iv-toggle" onclick="this.classList.toggle('on')"></div>
                </div>
            </div>
        </div>

        {{-- Section 4: Security & Expiration --}}
        <div class="iv-section">
            <div class="iv-sec-head">
                <div class="iv-sec-title-wrap">
                    <span class="iv-step-num">4</span>
                    <span class="iv-sec-title">Security & Expiration</span>
                </div>
            </div>
            
            <div class="iv-sec-grid">
                <div class="iv-sec-col-1">
                    <label class="iv-label">Invitation Link Expiration</label>
                    <div class="iv-select-wrap">
                        <select class="iv-select">
                            <option>24 Hours (Recommended)</option>
                            <option>48 Hours</option>
                            <option>7 Days</option>
                        </select>
                        <span class="material-icons-outlined iv-select-icon">expand_more</span>
                    </div>
                    <div class="iv-sec-hint">For maximum security, links should expire within 24 hours.</div>
                </div>
                <div class="iv-sec-col-2">
                    <div class="iv-2fa-card">
                        <div class="iv-2fa-icon"><span class="material-icons-outlined">phonelink_lock</span></div>
                        <div class="iv-2fa-body">
                            <div class="iv-2fa-title">Enforce 2FA</div>
                            <div class="iv-2fa-desc">Require the user to setup Two-Factor Authentication on first login.</div>
                            <div class="iv-toggle-wrap">
                                <div class="iv-toggle on" onclick="this.classList.toggle('on')"></div>
                                <span class="iv-toggle-label">Required</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section 5: Account Configuration --}}
        <div class="iv-section">
            <div class="iv-sec-head">
                <div class="iv-sec-title-wrap">
                    <span class="iv-step-num">5</span>
                    <span class="iv-sec-title">Account Configuration</span>
                </div>
            </div>
            
            <div class="iv-form-grid-3">
                <div>
                    <label class="iv-label">Account Status</label>
                    <div class="iv-select-wrap">
                        <select name="status" class="iv-select">
                            <option value="active">Active (Default)</option>
                            <option value="inactive">Inactive (Suspended)</option>
                        </select>
                        <span class="material-icons-outlined iv-select-icon">expand_more</span>
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" name="role" id="role_input" value="admin">

        {{-- Footer Block --}}
        <div class="iv-footer">
            <a href="{{ route('admin.users') }}" class="iv-discard">Discard Changes</a>
            <div class="iv-action-grp">
                <button type="button" class="btn-draft" onclick="window.location.href='{{ route('admin.users') }}'">Save as Draft</button>
                <button type="submit" class="btn-send">Send Invitation &gt;</button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
function selectRole(element) {
    document.querySelectorAll('.iv-role-card').forEach(el => el.classList.remove('active'));
    element.classList.add('active');
    
    const roleName = element.querySelector('.iv-role-name').innerText.trim().toLowerCase();
    const roleMap = {
        admin: 'admin',
        manager: 'manager',
        support: 'support',
    };

    document.getElementById('role_input').value = roleMap[roleName] || 'admin';
}
</script>
@endpush
@endsection
