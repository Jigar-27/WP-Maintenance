@extends('layouts.client')

@section('title', 'Monthly Maintenance Report')

@push('styles')
<style>
    .cr-header { margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: flex-end; }
    .cr-badge { display: inline-flex; align-items: center; gap: 6px; background: #e0e7ff; color: #4338ca; padding: 4px 10px; border-radius: 4px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem; }
    .cr-title { font-size: 1.5rem; font-weight: 800; color: #0f172a; margin: 0 0 0.25rem 0; }
    .cr-subtitle { font-size: 0.875rem; color: #64748b; }
    
    .cr-download-btn { display: flex; align-items: center; gap: 8px; font-size: 0.875rem; font-weight: 600; color: #ea580c; background: #fff7ed; padding: 0.5rem 1rem; border-radius: 6px; border: 1px solid #fed7aa; cursor: pointer; }
    
    .cr-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem; }
    .cr-grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem; }
    @media (max-width: 768px) { .cr-grid, .cr-grid-3 { grid-template-columns: 1fr; } }
    
    .cr-card { background: white; border-radius: 12px; padding: 1.5rem; border: 1px solid #e2e8f0; }
    
    /* Executive Summary */
    .cr-exec-title { font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 1rem; }
    .cr-exec-text { font-size: 1.25rem; font-weight: 700; color: #0f172a; line-height: 1.4; margin-bottom: 2rem; }
    .cr-exec-highlight { color: #ea580c; }
    .cr-stats-row { display: flex; justify-content: space-between; border-top: 1px solid #f1f5f9; padding-top: 1.5rem; }
    .cr-stat-val { font-size: 1.5rem; font-weight: 800; color: #0f172a; }
    .cr-stat-lbl { font-size: 0.75rem; color: #64748b; font-weight: 600; text-transform: uppercase; }
    
    /* Health Score */
    .cr-health-card { background: #b02f00; color: white; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; border: none; }
    .cr-health-title { font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 1.5rem; opacity: 0.9; }
    .cr-health-circle { width: 120px; height: 120px; border-radius: 50%; border: 4px solid rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; position: relative; }
    .cr-score { font-size: 2.5rem; font-weight: 800; line-height: 1; margin:0; }
    .cr-score-out { font-size: 1rem; opacity: 0.8; font-weight: 600; }
    .cr-health-desc { font-size: 0.75rem; opacity: 0.9; }

    /* Security & Performance */
    .cr-sec-item { display: flex; align-items: center; gap: 12px; margin-bottom: 1rem; }
    .cr-sec-icon { width: 8px; height: 8px; border-radius: 50%; background: #22c55e; }
    .cr-sec-title { font-size: 0.875rem; font-weight: 700; color: #0f172a; }
    .cr-sec-desc { font-size: 0.75rem; color: #64748b; margin-left: 20px; }

    .cr-perf-metric { display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem; font-size: 0.875rem; }
    .cr-perf-metric strong { color: #0f172a; font-weight: 700; }
    .cr-perf-bar-bg { width: 100%; height: 6px; background: #e2e8f0; border-radius: 3px; margin: 0.25rem 0 1rem; overflow: hidden; }
    .cr-perf-bar-fill { height: 100%; background: #ea580c; border-radius: 3px; }

    /* Updates & Backups */
    .cr-update-row { display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0; border-bottom: 1px solid #f1f5f9; font-size: 0.875rem; }
    .cr-update-row:last-child { border-bottom: none; }
    .cr-status-tag { display: inline-block; padding: 2px 8px; background: #dcfce7; color: #166534; border-radius: 4px; font-size: 0.7rem; font-weight: 700; }
    
    .cr-backup-main { display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; height: 100%; }
    .cr-backup-icon { width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; background: #f8fafc; border-radius: 50%; color: #64748b; margin-bottom: 1rem; }

    /* Recommendations */
    .cr-recs-card { background: #1e293b; color: white; border: none; margin-top: 1.5rem; }
    .cr-rec-title { font-size: 1.125rem; font-weight: 700; margin-bottom: 1.5rem; }
    .cr-rec-grid { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.5rem; }
    @media (max-width: 768px) { .cr-rec-grid { grid-template-columns: 1fr; } }
    .cr-rec-item h4 { margin: 0 0 0.5rem 0; font-size: 0.875rem; font-weight: 700; color: #f8fafc; }
    .cr-rec-item p { margin: 0; font-size: 0.75rem; color: #94a3b8; line-height: 1.5; }
    
    .cr-btn-approve { background: #ea580c; color: white; padding: 0.5rem 1rem; border-radius: 4px; font-weight: 600; font-size: 0.875rem; border: none; cursor: pointer; margin-top: 1.5rem; }
</style>
@endpush

@section('content')
<div class="cr-header">
    <div>
        <div class="cr-badge">Monthly Status Update</div>
        <h1 class="cr-title">Monthly Maintenance Report</h1>
        <div class="cr-subtitle">Reporting Period: October 2024</div>
    </div>
    <button type="button" class="cr-download-btn" onclick="window.print()">
        <span class="material-icons-outlined" style="font-size:18px;">picture_as_pdf</span>
        Download PDF
    </button>
</div>

<div class="cr-grid">
    <div class="cr-card">
        <div class="cr-exec-title">Executive Summary</div>
        <div class="cr-exec-text">
            Status: <span class="cr-exec-highlight">Protected & Optimized.</span><br>
            Your site remains in the top 5% of WordPress instances globally for performance and security.
        </div>
        
        <div class="cr-stats-row">
            <div>
                <div class="cr-stat-val">24</div>
                <div class="cr-stat-lbl">Core Updates</div>
            </div>
            <div>
                <div class="cr-stat-val">744</div>
                <div class="cr-stat-lbl">Security Scans</div>
            </div>
            <div>
                <div class="cr-stat-val">31</div>
                <div class="cr-stat-lbl">Cloud Backups</div>
            </div>
        </div>
    </div>
    
    <div class="cr-card cr-health-card">
        <div class="cr-health-title">Site Health Score</div>
        <div class="cr-health-circle">
            <div style="position:absolute; width:100%; height:100%; border-radius:50%; border:4px solid white; border-top-color:transparent; transform:rotate(-45deg);"></div>
            <div class="cr-score">98<span class="cr-score-out">/100</span></div>
        </div>
        <div class="cr-health-desc">Excellent - Above industry average.</div>
    </div>
</div>

<div class="cr-grid">
    <div class="cr-card" style="background:#f8fafc; border:none;">
        <div style="display:flex; align-items:center; gap:8px; margin-bottom:1.5rem;">
            <span class="material-icons-outlined" style="color:#0ea5e9;">verified_user</span>
            <span style="font- وزن:700; font-size:1rem; color:#0f172a; font-weight:bold;">Security Status</span>
        </div>
        
        <div class="cr-sec-item">
            <div class="cr-sec-icon"></div>
            <div>
                <div class="cr-sec-title">No security threats detected</div>
                <div class="cr-sec-desc">Malware scans completed 24 times. Firewall blocked 212 brute-force attempts this month.</div>
            </div>
        </div>
        <div class="cr-sec-item">
            <div class="cr-sec-icon"></div>
            <div>
                <div class="cr-sec-title">SSL Certificate</div>
                <div class="cr-sec-desc">Valid until March 2025. Auto-renew active.</div>
            </div>
        </div>
    </div>
    
    <div class="cr-card" style="background:#f1f5f9; border:none;">
        <div style="display:flex; align-items:center; gap:8px; margin-bottom:1.5rem;">
            <span class="material-icons-outlined" style="color:#6366f1;">insights</span>
            <span style="font-weight:700; font-size:1rem; color:#0f172a;">Performance Metrics</span>
        </div>
        
        <div class="cr-perf-metric">
            <span style="color:#64748b; font-weight:600;"><span class="material-icons-outlined" style="font-size:14px; vertical-align:middle; margin-right:4px;">bolt</span>Load Speed</span>
            <strong>0.8s</strong>
        </div>
        <div class="cr-perf-metric">
            <span style="color:#64748b; font-weight:600;"><span class="material-icons-outlined" style="font-size:14px; vertical-align:middle; margin-right:4px;">arrow_upward</span>Uptime</span>
            <strong style="color:#ea580c;">99.991%</strong>
        </div>
        
        <div style="margin-top:1.5rem;">
            <div class="cr-perf-metric" style="margin-bottom:0.25rem;">
                <span style="font-size:0.75rem; color:#64748b; font-weight:600;">Desktop Score</span>
                <span style="font-size:0.75rem; font-weight:700;">100%</span>
            </div>
            <div class="cr-perf-bar-bg"><div class="cr-perf-bar-fill" style="width:100%;"></div></div>
            
            <div class="cr-perf-metric" style="margin-bottom:0.25rem;">
                <span style="font-size:0.75rem; color:#64748b; font-weight:600;">Mobile Score</span>
                <span style="font-size:0.75rem; font-weight:700;">98%</span>
            </div>
            <div class="cr-perf-bar-bg"><div class="cr-perf-bar-fill" style="width:98%;"></div></div>
        </div>
    </div>
</div>

<div class="cr-grid">
    <div class="cr-card">
        <div style="display:flex; align-items:center; gap:8px; margin-bottom:1.5rem;">
            <span class="material-icons-outlined" style="color:#ea580c;">update</span>
            <span style="font-weight:700; font-size:1rem; color:#0f172a;">Updates Completed</span>
        </div>
        
        <div class="cr-update-row">
            <span>WordPress Core 6.4.2</span>
            <span class="cr-status-tag">Success</span>
        </div>
        <div class="cr-update-row">
            <span>14 Plugin Updates</span>
            <span class="cr-status-tag">Success</span>
        </div>
        <div class="cr-update-row">
            <span>Theme Filters & Accents</span>
            <span class="cr-status-tag">Success</span>
        </div>
    </div>
    
    <div class="cr-card">
        <div style="display:flex; align-items:center; gap:8px; margin-bottom:1.5rem;">
            <span class="material-icons-outlined" style="color:#0ea5e9;">cloud_done</span>
            <span style="font-weight:700; font-size:1rem; color:#0f172a;">Recent Backups</span>
        </div>
        
        <div class="cr-backup-main">
            <div class="cr-backup-icon">
                <span class="material-icons-outlined">cloud_sync</span>
            </div>
            <div style="font-size:0.875rem; font-weight:600; color:#0f172a; margin-bottom:0.25rem;">Daily Cloud Mirroring</div>
            <div style="font-size:0.75rem; color:#64748b;">Last Backup: Oct 15, 2024 4:00 AM</div>
        </div>
    </div>
</div>

<div class="cr-card cr-recs-card">
    <div class="cr-rec-title">Concierge Recommendations</div>
    <div class="cr-rec-grid">
        <div class="cr-rec-item">
            <h4><span class="material-icons-outlined" style="font-size:14px; color:#ea580c; vertical-align:middle;">image</span> Image Optimization</h4>
            <p>We've identified 12 source images above 1MB. Optimizing these could shave 0.3s on mobile load times.</p>
        </div>
        <div class="cr-rec-item">
            <h4><span class="material-icons-outlined" style="font-size:14px; color:#ea580c; vertical-align:middle;">public</span> Global Delivery</h4>
            <p>Consider a CDN for faster global speeds as we see increased traffic from Europe this month.</p>
        </div>
        <div class="cr-rec-item">
            <h4><span class="material-icons-outlined" style="font-size:14px; color:#ea580c; vertical-align:middle;">storage</span> Database Cleanup</h4>
            <p>Scheduled for next month: removal of 1,200 post revisions to keep the database lean and snappy.</p>
        </div>
    </div>
    <a href="{{ route('contact') }}" class="cr-btn-approve" style="display:inline-block; text-decoration:none;">Approve All Optimizations</a>
</div>
@endsection
