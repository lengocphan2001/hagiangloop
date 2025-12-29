<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('emails.contact_subject') }}</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <h2 style="color: #f59e0b; border-bottom: 2px solid #f59e0b; padding-bottom: 10px;">{{ __('emails.contact_subject') }}</h2>
    
    <div style="background-color: #f9fafb; padding: 20px; border-radius: 8px; margin-top: 20px;">
        <p><strong>{{ __('emails.name') }}:</strong> {{ e(is_string($contactName ?? null) ? $contactName : '') }}</p>
        <p><strong>{{ __('emails.whatsapp') }}:</strong> {{ e(is_string($whatsapp ?? null) ? $whatsapp : '') }}</p>
        <p><strong>{{ __('emails.email') }}:</strong> {{ e(is_string($email ?? null) ? $email : '') }}</p>
        <p><strong>{{ __('emails.country') }}:</strong> {{ e(is_string($country ?? null) ? $country : '') }}</p>
        <p><strong>{{ __('emails.message') }}:</strong></p>
        <div style="background-color: white; padding: 15px; border-radius: 5px; margin-top: 10px; white-space: pre-wrap;">{{ e(is_string($contactMessage ?? null) ? $contactMessage : '') }}</div>
    </div>
    
    <p style="margin-top: 20px; color: #666; font-size: 12px;">
        {{ __('emails.sent_from') }} {{ config('app.name') }}.
    </p>
</body>
</html>

