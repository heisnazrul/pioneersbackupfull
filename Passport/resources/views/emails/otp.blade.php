<x-mail::message>
# Your verification code

Use the code below to complete your {{ strtolower($purpose) }} request.

<x-mail::panel>
    <span style="font-size: 28px; letter-spacing: 6px; font-weight: 700; display: inline-block; padding: 12px 0;">
        {{ $code }}
    </span>
</x-mail::panel>

@if ($expiresAtHuman)
This code will expire {{ $expiresAtHuman }}.
@endif

If you did not request this action, you can safely ignore this email.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
