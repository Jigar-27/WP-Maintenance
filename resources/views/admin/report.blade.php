<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Monthly Maintenance Report</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <style>
        :root {
            --rp-bg: #f5f7fa;
            --rp-dark: #1e293b;
            --rp-text: #334155;
            --rp-light: #64748b;
            --rp-orange: #ea580c;
            --rp-orange-light: #fff7ed;
            --rp-blue-bg: #f8fafc;
            --rp-green: #10b981;
            --space-2: 0.5rem;
            --space-4: 1rem;
            --space-6: 1.5rem;
            --space-8: 2rem;
            --border: #e2e8f0;
        }
        body { margin: 0; background: var(--rp-bg); font-family: 'Inter', sans-serif; color: var(--rp-text); }
        h1, h2, h3, h4, p { margin: 0; }
        
        /* Top Navigation Bar */
        .rp-nav {
            background: white; border-bottom: 1px solid var(--border);
            padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center;
        }
        .rp-brand { display: flex; align-items: center; gap: 8px; font-weight: 800; font-size: 1.125rem; color: var(--rp-dark); }
        .rp-brand-icon { width: 24px; height: 24px; background: #ea580c; color: white; display: flex; align-items: center; justify-content: center; border-radius: 6px; }
        .rp-links { display: flex; gap: 2.5rem; }
        .rp-links a { text-decoration: none; color: var(--rp-light); font-weight: 700; font-size: 0.875rem; transition: color 0.2s; position: relative; }
        .rp-links a.active { color: var(--rp-orange); }
        .rp-links a.active::after { content: ''; position: absolute; bottom: -18px; left: 0; right: 0; height: 3px; background: var(--rp-orange); border-radius: 3px; }
        .rp-tools { display: flex; align-items: center; gap: 1.5rem; }
        .rp-btn { background: var(--rp-orange); color: white; padding: 0.625rem 1.25rem; border-radius: 6px; font-weight: 700; font-size: 0.8125rem; text-decoration: none; display: flex; gap: 6px; align-items: center; }
        .rp-av { width: 32px; height: 32px; border-radius: 50%; background: #cbd5e0; object-fit: cover; }

        /* Document Wrapper */
        .rp-doc-wrap { max-width: 1000px; margin: 3rem auto; background: white; border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.05); padding: 4rem; position: relative; }
        
        /* Header Block */
        .rp-head { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 3rem; }
        .rp-pill { background: #eff6ff; color: #3b82f6; padding: 6px 14px; border-radius: 20px; font-size: 0.6875rem; font-weight: 800; letter-spacing: 0.05em; display: inline-block; margin-bottom: 1rem; }
        .rp-title { font-size: 2.5rem; font-weight: 800; color: var(--rp-dark); letter-spacing: -0.02em; margin-bottom: 0.5rem; }
        .rp-sub { font-size: 1rem; font-weight: 600; color: var(--rp-light); }
        
        .rp-cloud-box { background: #f8fafc; border: 1px solid var(--border); padding: 1rem; border-radius: 12px; display: flex; align-items: center; gap: 12px; }
        .rp-cloud-box .c-icon { font-size: 2rem; color: var(--rp-orange); }
        .rp-cloud-lbl { font-size: 0.6875rem; font-weight: 800; color: var(--rp-light); text-transform: uppercase; margin-bottom: 2px; }
        .rp-cloud-val { font-size: 0.8125rem; font-weight: 700; color: var(--rp-dark); }

        /* Grid Framework */
        .rp-grid { display: grid; grid-template-columns: 1.5fr 1fr; gap: var(--space-6); margin-bottom: var(--space-6); }
        .rp-card { background: white; border: 1px solid var(--border); border-radius: 16px; padding: 2rem; position: relative; }
        .rp-card-gray { background: #f8fafc; border: none; }
        
        .rp-lbl { font-size: 0.6875rem; font-weight: 800; color: var(--rp-light); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 1rem; }

        /* Executive Summary */
        .ex-text { font-size: 1.25rem; font-weight: 500; color: var(--rp-dark); line-height: 1.5; margin-bottom: 2rem; }
        .ex-text span { color: var(--rp-orange); font-weight: 700; }
        .ex-stats { display: flex; gap: 3rem; }
        .ex-st-val { font-size: 1.25rem; font-weight: 800; color: var(--rp-dark); }
        .ex-st-lbl { font-size: 0.75rem; font-weight: 600; color: var(--rp-light); }
        .ex-icon-abs { position: absolute; right: 2rem; top: 1.5rem; font-size: 5rem; color: #f1f5f9; }

        /* Health Score */
        .hl-card { background: #d03d00; border: none; color: white; display: flex; flex-direction: column; align-items: center; text-align: center; }
        .hl-card .rp-lbl { color: #ffedd5; }
        .hl-circle { width: 140px; height: 140px; border-radius: 50%; border: 6px solid rgba(255,255,255,0.2); border-top-color: white; display: flex; flex-direction: column; align-items: center; justify-content: center; margin-bottom: 1.5rem; }
        .hl-score { font-size: 2.5rem; font-weight: 800; line-height: 1; margin-bottom: 4px; }
        .hl-sub { font-size: 0.875rem; font-weight: 600; color: rgba(255,255,255,0.8); }
        .hl-desc { font-size: 0.8125rem; font-weight: 500; }

        /* Security Status */
        .sec-list { display: flex; flex-direction: column; gap: 1.5rem; }
        .sec-item { display: flex; gap: 1rem; align-items: flex-start; }
        .sec-icon { color: var(--rp-green); font-size: 1.25rem; margin-top: 2px; }
        .sec-title { font-size: 0.9375rem; font-weight: 800; color: var(--rp-dark); margin-bottom: 4px; }
        .sec-desc { font-size: 0.8125rem; color: var(--rp-light); line-height: 1.5; }

        /* Performance Metrics */
        .pm-list { display: flex; flex-direction: column; gap: 1.5rem; }
        .pm-item { margin-bottom: 1rem; }
        .pm-top { display: flex; justify-content: space-between; font-size: 0.875rem; font-weight: 800; margin-bottom: 6px; }
        .pm-bar-bg { width: 100%; height: 6px; background: #e2e8f0; border-radius: 3px; overflow: hidden; }
        .pm-bar-fill { height: 100%; border-radius: 3px; }
        
        .color-green { color: var(--rp-green); } .bg-green { background: var(--rp-green); width: 95%; }
        .color-blue { color: #3b82f6; } .bg-blue { background: #3b82f6; width: 99.9%; }
        .color-orange { color: #f59e0b; } .bg-orange { background: #f59e0b; width: 92%; }

        /* Updates List */
        .up-row { display: flex; justify-content: space-between; align-items: center; padding: 1rem 0; border-bottom: 1px solid #f1f5f9; }
        .up-row:last-child { border-bottom: none; }
        .up-name { font-size: 0.875rem; font-weight: 700; color: var(--rp-dark); }
        .up-badge { background: #dcfce7; color: #166534; padding: 4px 10px; border-radius: 4px; font-size: 0.6875rem; font-weight: 800; }

        /* Recent Backups */
        .bk-wrap { text-align: center; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%; }
        .bk-icon { font-size: 2.5rem; color: var(--rp-light); margin-bottom: 1rem; }
        .bk-title { font-size: 0.9375rem; font-weight: 700; color: var(--rp-dark); margin-bottom: 4px; }
        .bk-time { font-size: 0.75rem; color: var(--rp-light); }

        /* Concierge Recommendations */
        .cr-card { background: #0f172a; border-radius: 16px; padding: 3rem; color: white; display: grid; grid-template-columns: repeat(3, 1fr); gap: 3rem; }
        .cr-card > div:first-child { grid-column: span 3; margin-bottom: -1rem; display: flex; justify-content: space-between; align-items: center; }
        .cr-lbl { font-size: 1rem; font-weight: 800; color: white; }
        
        .cr-item-num { font-size: 0.75rem; font-weight: 800; color: #94a3b8; margin-bottom: 6px; }
        .cr-item-title { font-size: 0.9375rem; font-weight: 800; color: white; margin-bottom: 0.5rem; }
        .cr-item-desc { font-size: 0.8125rem; color: #94a3b8; line-height: 1.6; }
        
        .cr-btn { background: var(--rp-orange); color: white; border: none; padding: 0.625rem 1rem; border-radius: 6px; font-weight: 700; font-size: 0.75rem; cursor: pointer; display: block; margin-top: 1rem; }

        /* Footer */
        .rp-footer { margin-top: 4rem; padding-top: 2rem; border-top: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center;}
        .rp-f-left { display: flex; flex-direction: column; gap: 4px; }
        .rp-f-brand { font-size: 0.8125rem; font-weight: 800; color: var(--rp-dark); }
        .rp-f-copy { font-size: 0.75rem; color: var(--rp-light); }
        .rp-f-links { display: flex; gap: 1.5rem; font-size: 0.75rem; font-weight: 600; }
        .rp-f-links a { color: var(--rp-light); text-decoration: none; }
    </style>
</head>
<body>

    <nav class="rp-nav">
        <div class="rp-brand">
            <div class="rp-brand-icon"><span class="material-icons-outlined" style="font-size:14px;">lock</span></div>
            WordPress Concierge
        </div>
        <div class="rp-links">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.report') }}" class="active">Reports</a>
            <a href="{{ route('admin.settings') }}">Settings</a>
            <a href="{{ route('contact') }}">Support</a>
        </div>
        <div class="rp-tools">
            <a href="javascript:void(0)" onclick="window.print()" class="rp-btn"><span class="material-icons-outlined" style="font-size:14px;">picture_as_pdf</span> Download PDF</a>
            <img src="https://ui-avatars.com/api/?name=User&background=cbd5e0" class="rp-av" alt="Avatar">
        </div>
    </nav>

    <div class="rp-doc-wrap">
        
        <div class="rp-head">
            <div>
                <div class="rp-pill">REPORT STATUS: ACTIVE</div>
                <h1 class="rp-title">Monthly Maintenance Report</h1>
                <div class="rp-sub">Reporting Period: October 2024</div>
            </div>
            <div class="rp-cloud-box">
                <span class="material-icons-outlined c-icon">cloud_queue</span>
                <div>
                    <div class="rp-cloud-lbl">Cloud Backup</div>
                    <div class="rp-cloud-val">Next scheduled in 2 hours</div>
                </div>
            </div>
        </div>

        <div class="rp-grid">
            <!-- Executive Summary -->
            <div class="rp-card">
                <div class="rp-lbl">Executive Summary</div>
                <div class="ex-text">Status: <span>Protected & Optimized.</span> Your site remains in the top 5% of WordPress instances globally for performance and security.</div>
                <div class="ex-stats">
                    <div>
                        <div class="ex-st-val">24</div>
                        <div class="ex-st-lbl">Total Updates</div>
                    </div>
                    <div>
                        <div class="ex-st-val">744</div>
                        <div class="ex-st-lbl">Security Scans</div>
                    </div>
                    <div>
                        <div class="ex-st-val">31</div>
                        <div class="ex-st-lbl">Cloud Backups</div>
                    </div>
                </div>
                <span class="material-icons-outlined ex-icon-abs">verified_user</span>
            </div>

            <!-- Health Score -->
            <div class="rp-card hl-card">
                <div class="rp-lbl">Site Health Score</div>
                <div class="hl-circle">
                    <div class="hl-score">98</div>
                    <div class="hl-sub">/100</div>
                </div>
                <div class="hl-desc">Excellent. Above industry average.</div>
            </div>
        </div>

        <div class="rp-grid">
            <!-- Security Status -->
            <div class="rp-card">
                <div class="rp-lbl"><span class="material-icons-outlined" style="font-size:12px; vertical-align:middle; color:var(--rp-green);">check_circle</span> Security Status</div>
                <div class="sec-list">
                    <div class="sec-item">
                        <span class="material-icons-outlined sec-icon">verified</span>
                        <div>
                            <div class="sec-title">No security threats detected</div>
                            <div class="sec-desc">Malware scans complete. 0 issues. Firewall blocked 672 brute-force attempts this month.</div>
                        </div>
                    </div>
                    <div class="sec-item">
                        <span class="material-icons-outlined sec-icon">lock</span>
                        <div>
                            <div class="sec-title">SSL Certificate</div>
                            <div class="sec-desc">Valid until March 2025. Auto-renewal active.</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Performance Metrics -->
            <div class="rp-card rp-card-gray">
                <div class="rp-lbl">Performance Metrics</div>
                <div class="pm-list">
                    <div class="pm-item">
                        <div class="pm-top">
                            <span><span class="material-icons-outlined" style="font-size:14px; vertical-align:middle;">bolt</span> Load Speed</span>
                            <span class="color-green">0.8s</span>
                        </div>
                        <div class="pm-bar-bg"><div class="pm-bar-fill bg-green"></div></div>
                    </div>
                    <div class="pm-item">
                        <div class="pm-top">
                            <span><span class="material-icons-outlined" style="font-size:14px; vertical-align:middle;">access_time</span> Uptime</span>
                            <span class="color-blue">99.99%</span>
                        </div>
                        <div class="pm-bar-bg"><div class="pm-bar-fill bg-blue"></div></div>
                    </div>
                    <div class="pm-item">
                        <div class="pm-top">
                            <span><span class="material-icons-outlined" style="font-size:14px; vertical-align:middle;">insights</span> Core Web Vitals</span>
                            <span class="color-orange">Excellent</span>
                        </div>
                        <div class="pm-bar-bg"><div class="pm-bar-fill bg-orange"></div></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="rp-grid">
            <!-- Updates Completed -->
            <div class="rp-card">
                <div class="rp-lbl"><span class="material-icons-outlined" style="font-size:12px; vertical-align:middle; color:#e53e3e;">swap_vert</span> Updates Completed</div>
                <div>
                    <div class="up-row">
                        <div class="up-name">WordPress Core 6.4.3</div>
                        <div class="up-badge">Success</div>
                    </div>
                    <div class="up-row">
                        <div class="up-name">18 Plugins Updated</div>
                        <div class="up-badge">Success</div>
                    </div>
                    <div class="up-row">
                        <div class="up-name">Theme Files & Assets</div>
                        <div class="up-badge">Success</div>
                    </div>
                </div>
            </div>

            <!-- Recent Backups -->
            <div class="rp-card rp-card-gray">
                <div class="rp-lbl"><span class="material-icons-outlined" style="font-size:12px; vertical-align:middle; color:#ea580c;">cloud</span> Recent Backups</div>
                <div class="bk-wrap">
                    <span class="material-icons-outlined bk-icon">backup</span>
                    <div class="bk-title">Daily Cloud Mirroring</div>
                    <div class="bk-time">Last backup: Oct 31, 2024 @ 4:00 AM</div>
                </div>
            </div>
        </div>

        <!-- Concierge Recommendations -->
        <div class="cr-card">
            <div><div class="cr-lbl">Concierge Recommendations</div></div>
            
            <div>
                <div class="cr-item-num">01</div>
                <div class="cr-item-title">Image Optimization</div>
                <div class="cr-item-desc">We've identified 2 banner images above 1MB. Optimizing these could save 0.4s on initial mobile load.</div>
                <a href="{{ route('contact') }}" class="cr-btn" style="text-decoration:none;">Approve All Optimizations</a>
            </div>
            <div>
                <div class="cr-item-num">02</div>
                <div class="cr-item-title">Global Delivery</div>
                <div class="cr-item-desc">Consider a CDN for faster global speeds as we see increased traffic from Europe this month.</div>
            </div>
            <div>
                <div class="cr-item-num">03</div>
                <div class="cr-item-title">Database Cleanup</div>
                <div class="cr-item-desc">Scheduled for next month: removal of 1,200 post revisions to keep the database lean and snappy.</div>
            </div>
        </div>

        <div class="rp-footer">
            <div class="rp-f-left">
                <div class="rp-f-brand">WordPress Concierge</div>
                <div class="rp-f-copy">© 2024 WordPress Care. Your site is in safe hands.</div>
            </div>
            <div class="rp-f-links">
                <a href="{{ route('contact') }}">Support Desk</a>
                <a href="{{ route('privacy') }}">Privacy Policy</a>
                <a href="{{ route('contact') }}">Contact Us</a>
            </div>
        </div>

    </div>

</body>
</html>
