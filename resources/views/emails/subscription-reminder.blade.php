<!DOCTYPE html>
<html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"></head>
<body style="margin:0;padding:0;background:#f8f9ff;font-family:'Inter',-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;margin:40px auto;background:#ffffff;border-radius:16px;overflow:hidden;">
    <tr><td style="background:{{ $daysRemaining > 5 ? '#13264B' : ($daysRemaining > 0 ? '#cda72c' : '#ba1a1a') }};padding:40px;text-align:center;color:#fff">
        <h1 style="margin:0;font-size:24px;font-weight:700">
            @if($daysRemaining > 0)
                Subscription Expiring in {{ $daysRemaining }} Days
            @else
                Your Subscription Has Expired Today
            @endif
        </h1>
        <p style="margin:10px 0 0;font-size:14px;opacity:0.9">Action required — WP Maintenance</p>
    </td></tr>
    <tr><td style="padding:40px">
        <p style="font-size:16px;color:#0d1c2e;line-height:1.6">Hi <strong>{{ $subscription->client->first_name }}</strong>,</p>

        @if($daysRemaining > 0)
        <p style="font-size:15px;color:#5b4039;line-height:1.7;margin:16px 0">This is a friendly reminder that your <strong>{{ $subscription->plan->name }}</strong> subscription will expire in <strong>{{ $daysRemaining }} days</strong> on <strong>{{ $subscription->end_date->format('F d, Y') }}</strong>.</p>
        @else
        <p style="font-size:15px;color:#5b4039;line-height:1.7;margin:16px 0">Your <strong>{{ $subscription->plan->name }}</strong> subscription has expired today. To continue receiving WordPress maintenance services, please renew your subscription.</p>
        @endif

        <table width="100%" style="background:#eff4ff;border-radius:12px;margin:24px 0" cellpadding="0" cellspacing="0">
            <tr><td style="padding:24px">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr><td style="padding:8px 0;font-size:13px;color:#5b4039">Plan</td><td style="padding:8px 0;font-size:15px;font-weight:600;text-align:right;color:#0d1c2e">{{ $subscription->plan->name }}</td></tr>
                    <tr><td style="padding:8px 0;font-size:13px;color:#5b4039">Website</td><td style="padding:8px 0;font-size:15px;text-align:right;color:#0d1c2e">{{ $subscription->client->website_url }}</td></tr>
                    <tr><td style="padding:8px 0;font-size:13px;color:#5b4039">Expiry Date</td><td style="padding:8px 0;font-size:15px;font-weight:600;text-align:right;color:#b02f00">{{ $subscription->end_date->format('F d, Y') }}</td></tr>
                </table>
            </td></tr>
        </table>

        <table cellpadding="0" cellspacing="0" style="margin:24px 0"><tr>
            <td style="background:linear-gradient(135deg,#b02f00,#FF5722);border-radius:12px;padding:14px 32px;text-align:center">
                <a href="{{ url('/plans') }}" style="color:#ffffff;text-decoration:none;font-size:15px;font-weight:600">Renew Subscription</a>
            </td>
        </tr></table>

        @if($daysRemaining == 0)
        <p style="font-size:14px;color:#ba1a1a;line-height:1.65;background:#ffdad6;padding:16px;border-radius:8px;margin:16px 0"><strong>Important:</strong> If your subscription is not renewed, all associated data will be removed from our systems.</p>
        @endif

        <p style="font-size:14px;color:#5b4039;line-height:1.65;margin-top:24px">If you have any questions, please contact us at {{ \App\Models\Setting::get('support_email', 'support@unitedwpagency.com') }}.</p>
        <p style="font-size:14px;color:#5b4039;margin-top:20px">Best regards,<br><strong>WP Maintenance Team</strong></p>
    </td></tr>
    <tr><td style="background:#d5e3fc;padding:24px;text-align:center;font-size:12px;color:#5b4039">
        © {{ date('Y') }} WP Maintenance — A product by ReUnited Technologies
    </td></tr>
</table>
</body></html>
