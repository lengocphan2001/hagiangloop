<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <h2 style="color: #f59e0b; border-bottom: 2px solid #f59e0b; padding-bottom: 10px;">New Contact Form Submission</h2>
    
    <div style="background-color: #f9fafb; padding: 20px; border-radius: 8px; margin-top: 20px;">
        <p><strong>Name:</strong> {{ e($contactName ?? '') }}</p>
        <p><strong>WhatsApp:</strong> {{ e($whatsapp ?? '') }}</p>
        <p><strong>Email:</strong> {{ e($email ?? '') }}</p>
        <p><strong>Country:</strong> {{ e($country ?? '') }}</p>
        <p><strong>Message:</strong></p>
        <div style="background-color: white; padding: 15px; border-radius: 5px; margin-top: 10px; white-space: pre-wrap;">{{ e($contactMessage ?? '') }}</div>
    </div>
    
    <p style="margin-top: 20px; color: #666; font-size: 12px;">
        This email was sent from the contact form on {{ config('app.name') }}.
    </p>
</body>
</html>

