<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agency Console Login — United WP agency</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <style>
        :root {
            --cp-primary: #ea580c;
            --cp-primary-hover: #c2410c;
            --cp-dark: #0f172a;
            --cp-bg: #f8fafc;
            --cp-text: #334155;
            --cp-border: #e2e8f0;
        }
        * { box-sizing: border-box; }
        body { 
            margin: 0; padding: 0; font-family: 'Inter', sans-serif; 
            background: var(--cp-bg); color: var(--cp-text);
            display: flex; align-items: center; justify-content: center; min-height: 100vh;
        }
        
        .login-wrap {
            display: flex; width: 100%; max-width: 1000px; 
            background: white; border-radius: 20px; overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.05); margin: 2rem;
        }

        /* Left side visual */
        .login-visual {
            background: var(--cp-dark); color: white; flex: 1; padding: 4rem; 
            display: flex; flex-direction: column; justify-content: center; relative;
        }
        .v-title { font-size: 2.25rem; font-weight: 800; margin-bottom: 1rem; line-height: 1.2; letter-spacing: -0.02em; }
        .v-title span { color: var(--cp-primary); }
        .v-desc { font-size: 1rem; color: #94a3b8; line-height: 1.6; margin-bottom: 3rem; }
        .v-stats { display: flex; gap: 2rem; }
        .v-stat { display: flex; flex-direction: column; }
        .v-stat-val { font-size: 1.5rem; font-weight: 800; color: white; display:flex; align-items:center; gap:6px; }
        .v-stat-lbl { font-size: 0.75rem; color: #64748b; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; }

        /* Right side form */
        .login-form-box {
            flex: 1; padding: 4rem; display: flex; flex-direction: column; justify-content: center;
        }
        .lf-head { margin-bottom: 2rem; }
        .lf-icon { width: 48px; height: 48px; background: #fff5eb; color: var(--cp-primary); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; box-shadow: 0 4px 10px rgba(234, 88, 12, 0.05);}
        .lf-title { font-size: 1.5rem; font-weight: 800; color: var(--cp-dark); margin-bottom: 0.25rem; }
        .lf-sub { font-size: 0.875rem; color: #64748b; }

        .form-group { margin-bottom: 1.5rem; }
        .form-label { display: block; font-size: 0.75rem; font-weight: 800; color: #64748b; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.05em; }
        .form-input {
            width: 100%; padding: 0.875rem 1rem; border: 1px solid var(--cp-border); border-radius: 8px;
            font-size: 0.9375rem; font-family: 'Inter', sans-serif; color: var(--cp-dark); transition: border 0.2s; outline: none;
            background: #f8fafc;
        }
        .form-input:focus { border-color: var(--cp-primary); background: white; }
        
        .form-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
        .form-checkbox { display: flex; align-items: center; gap: 8px; font-size: 0.875rem; color: var(--cp-text); }
        .form-checkbox input { accent-color: var(--cp-primary); width: 16px; height: 16px; cursor: pointer; }
        
        .btn-submit {
            width: 100%; padding: 1rem; background: var(--cp-primary); color: white; border: none; border-radius: 8px;
            font-size: 0.9375rem; font-weight: 700; cursor: pointer; transition: background 0.2s;
        }
        .btn-submit:hover { background: var(--cp-primary-hover); }

        .back-link {
            display: inline-block; margin-top: 2rem; color: #64748b; text-decoration: none; font-size: 0.8125rem; font-weight: 600;
            transition: color 0.2s; text-align: center; width: 100%;
        }
        .back-link:hover { color: var(--cp-dark); }
        
        .alert-error {
            background: #fef2f2; border: 1px solid #fecaca; color: #ef4444; padding: 1rem; border-radius: 8px;
            font-size: 0.875rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 8px;
        }

        @media(max-width: 768px) {
            .login-wrap { flex-direction: column; }
            .login-visual { padding: 3rem 2rem; }
            .login-form-box { padding: 3rem 2rem; }
        }
    </style>
</head>
<body>

    <div class="login-wrap">
        <div class="login-visual">
            <h1 class="v-title">Agency Console.<br>Fleet Management.<br><span>Secured.</span></h1>
            <p class="v-desc">Access the centralized command center for United WP agency. Manage fleet infrastructure, security protocols, and client orchestration from a single administrative interface.</p>
            
            <div class="v-stats">
                <div class="v-stat">
                    <div class="v-stat-val"><span class="material-icons-outlined" style="color:#10b981; font-size:18px;">bolt</span> 99.99%</div>
                    <div class="v-stat-lbl">Uptime Target</div>
                </div>
                <div class="v-stat">
                    <div class="v-stat-val"><span class="material-icons-outlined" style="color:#3b82f6; font-size:18px;">shield</span> 24/7</div>
                    <div class="v-stat-lbl">Security Monitoring</div>
                </div>
            </div>
        </div>
        
        <div class="login-form-box">
            <div class="lf-head">
                <div class="lf-icon"><span class="material-icons-outlined" style="font-size:1.5rem;">lock</span></div>
                <h2 class="lf-title">Agency Console</h2>
                <div class="lf-sub">Administrative access for United WP agency staff.</div>
            </div>

            @if($errors->any())
                <div class="alert-error">
                    <span class="material-icons-outlined" style="font-size:1.125rem;">error</span>
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.authenticate') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="email">Work Email</label>
                    <input type="email" class="form-input" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="name@company.com">
                </div>
                
                <div class="form-group" style="margin-bottom:0.5rem">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" class="form-input" id="password" name="password" required placeholder="Enter your secure password">
                    <div style="text-align: right; margin-top: 8px;">
                        <a href="mailto:{{ \App\Models\Setting::get('support_email', 'support@unitedwpagency.com') }}?subject=Password%20Reset%20Request" style="font-size: 0.75rem; color: #64748b; text-decoration: none; font-weight: 600;">Forgot Password?</a>
                    </div>
                </div>
                
                <div class="form-row">
                    <label class="form-checkbox">
                        <input type="checkbox" id="remember" name="remember">
                        Remember me
                    </label>
                </div>

                <button type="submit" class="btn-submit">Secure Log In</button>
            </form>

            <a href="{{ route('home') }}" class="back-link">← Return to Main Website</a>
        </div>
    </div>

</body>
</html>
