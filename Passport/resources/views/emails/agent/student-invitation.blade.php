@component('mail::message')
# Welcome to the {{ config('app.name') }} family!

Hi {{ $student->name }},

{{ optional($agent->user)->name ?? 'Your agent' }} just invited you to continue your journey with Course English. We’ve prepared a secure student account for you—use the button below to finish your profile and unlock your dashboard.

@component('mail::panel')
**Why complete your profile now?**

- Track offers, intakes, and requirements in one place  
- Message your counselor or agent instantly  
- Receive personalized updates about your application
@endcomponent

@component('mail::button', ['url' => $onboardUrl])
Activate My Account
@endcomponent

If the button doesn’t work, copy the link below into your browser:
{{ $onboardUrl }}

We can’t wait to see what you achieve next.

Warm regards,  
**The {{ config('app.name') }} Team**
@endcomponent
