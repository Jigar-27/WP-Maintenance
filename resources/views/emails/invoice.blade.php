<!DOCTYPE html>
<html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"></head>
<body style="margin:0;padding:0;background:#f8f9ff;font-family:'Inter',-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;margin:40px auto;background:#ffffff;border-radius:16px;overflow:hidden;">
    <tr><td style="background:#13264B;padding:40px;text-align:center;color:#fff">
        <h1 style="margin:0;font-size:24px;font-weight:700">Invoice #{{ $invoice->invoice_number }}</h1>
        <p style="margin:10px 0 0;font-size:14px;opacity:0.8">{{ $invoice->issue_date->format('F d, Y') }}</p>
    </td></tr>
    <tr><td style="padding:40px">
        <p style="font-size:16px;color:#0d1c2e;line-height:1.6">Hi <strong>{{ $invoice->client->first_name }}</strong>,</p>
        <p style="font-size:15px;color:#5b4039;line-height:1.7;margin:16px 0">Here is your invoice for your WP Maintenance subscription.</p>

        <table width="100%" style="background:#eff4ff;border-radius:12px;margin:24px 0" cellpadding="0" cellspacing="0">
            <tr><td style="padding:24px">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr style="border-bottom:1px solid #dce9ff"><td style="padding:12px 0;font-size:13px;color:#5b4039;font-weight:600;text-transform:uppercase;letter-spacing:0.05em">Description</td><td style="padding:12px 0;font-size:13px;color:#5b4039;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;text-align:right">Amount</td></tr>
                    <tr><td style="padding:16px 0;font-size:15px;color:#0d1c2e">{{ $invoice->subscription->plan->name ?? 'Maintenance Plan' }} — Monthly</td><td style="padding:16px 0;font-size:15px;color:#0d1c2e;text-align:right">${{ number_format($invoice->subtotal, 2) }}</td></tr>
                    <tr><td style="padding:8px 0;font-size:14px;color:#5b4039">Tax (18%)</td><td style="padding:8px 0;font-size:14px;color:#5b4039;text-align:right">${{ number_format($invoice->tax, 2) }}</td></tr>
                    <tr style="border-top:2px solid #c0d1ff"><td style="padding:16px 0;font-size:18px;font-weight:700;color:#0d1c2e">Total</td><td style="padding:16px 0;font-size:18px;font-weight:700;color:#b02f00;text-align:right">${{ number_format($invoice->total, 2) }}</td></tr>
                </table>
            </td></tr>
        </table>

        <table width="100%" style="margin:24px 0" cellpadding="0" cellspacing="0">
            <tr><td style="padding:6px 0;font-size:13px;color:#5b4039">Invoice Number</td><td style="padding:6px 0;font-size:14px;color:#0d1c2e;text-align:right">{{ $invoice->invoice_number }}</td></tr>
            <tr><td style="padding:6px 0;font-size:13px;color:#5b4039">Issue Date</td><td style="padding:6px 0;font-size:14px;color:#0d1c2e;text-align:right">{{ $invoice->issue_date->format('M d, Y') }}</td></tr>
            <tr><td style="padding:6px 0;font-size:13px;color:#5b4039">Due Date</td><td style="padding:6px 0;font-size:14px;color:#0d1c2e;text-align:right">{{ $invoice->due_date->format('M d, Y') }}</td></tr>
            <tr><td style="padding:6px 0;font-size:13px;color:#5b4039">Status</td><td style="padding:6px 0;font-size:14px;font-weight:600;color:#166534;text-align:right">{{ ucfirst($invoice->status) }}</td></tr>
        </table>

        <p style="font-size:14px;color:#5b4039;line-height:1.65;margin-top:24px">If you have any questions about this invoice, please contact us at billing@wpmaintenance.com.</p>
        <p style="font-size:14px;color:#5b4039;margin-top:20px">Best regards,<br><strong>WP Maintenance Billing</strong></p>
    </td></tr>
    <tr><td style="background:#d5e3fc;padding:24px;text-align:center;font-size:12px;color:#5b4039">
        © {{ date('Y') }} WP Maintenance — A product by ReUnited Technologies
    </td></tr>
</table>
</body></html>
