@component('mail::message')
# TRC App Password Reset

We received a request to reset your password.
Your OTP code is:

## **{{ $otp }}**

This code will expire in **30 minutes**.

@component('mail::button', ['url' => 'http://localhost/trc/'])
Open TRC App
@endcomponent

If you did not request a password reset, no further action is required.

Thanks,
{{ config('app.name') }}
@endcomponent
