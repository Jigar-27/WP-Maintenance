<!DOCTYPE html>
<html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"></head>
<body style="margin:0;padding:0;background:#f8f9ff;font-family:'Inter',-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;margin:40px auto;background:#ffffff;border-radius:16px;overflow:hidden;">
    <tr><td style="background:linear-gradient(135deg,#cda72c,#F2C94C);padding:40px;text-align:center;color:#0d1c2e">
        <h1 style="margin:0;font-size:24px;font-weight:700">🎉 New Client Subscription</h1>
        <p style="margin:10px 0 0;font-size:14px;opacity:0.8">A new client just signed up!</p>
    </td></tr>
    <tr><td style="padding:40px">
        <p style="font-size:16px;color:#0d1c2e;line-height:1.6">Hello Admin,</p>
        <p style="font-size:15px;color:#5b4039;line-height:1.7;margin:16px 0">A new client has subscribed to WP Maintenance. Here are the details:</p>

        <table width="100%" style="background:#eff4ff;border-radius:12px;margin:24px 0" cellpadding="0" cellspacing="0">
            <tr><td style="padding:24px">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr><td style="padding:8px 0;font-size:13px;color:#5b4039">Client Name</td><td style="padding:8px 0;font-size:15px;font-weight:600;text-align:right;color:#0d1c2e">{{ $subscription->client->full_name }}</td></tr>
                    <tr><td style="padding:8px 0;font-size:13px;color:#5b4039">Email</td><td style="padding:8px 0;font-size:15px;text-align:right;color:#0d1c2e">{{ $subscription->client->email }}</td></tr>
                    <tr><td style="padding:8px 0;font-size:13px;color:#5b4039">Company</td><td style="padding:8px 0;font-size:15px;text-align:right;color:#0d1c2e">{{ $subscription->client->company_name ?? '—' }}</td></tr>
                    <tr><td style="padding:8px 0;font-size:13px;color:#5b4039">Website</td><td style="padding:8px 0;font-size:15px;text-align:right;color:#0d1c2e">{{ $subscription->client->website_url }}</td></tr>
                    <tr><td style="padding:8px 0;font-size:13px;color:#5b4039">Plan</td><td style="padding:8px 0;font-size:15px;font-weight:600;text-align:right;color:#b02f00">{{ $subscription->plan->name }}</td></tr>
                    <tr><td style="padding:8px 0;font-size:13px;color:#5b4039">Amount</td><td style="padding:8px 0;font-size:18px;font-weight:700;text-align:right;color:#b02f00">${{ number_format($subscription->amount, 2) }}/mo</td></tr>
                </table>
            </td></tr>
        </table>

        <p style="font-size:14px;color:#5b4039;line-height:1.65">Log in to the <a href="{{ url('/admin/dashboard') }}" style="color:#b02f00;font-weight:600">Agency Console</a> to manage this client.</p>
    </td></tr>
    <tr><td style="background:#d5e3fc;padding:24px;text-align:center;font-size:12px;color:#5b4039">
        © {{ date('Y') }} WP Maintenance — A product by ReUnited Technologies
    </td></tr>
</table>
</body></html>
