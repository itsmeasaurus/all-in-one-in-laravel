@component('mail::message')
# Hello {{ $user->name }} Welcome to our website!

Thank you for joining our community. We are excited to have you on board.

If you have any questions, feel free to reach out to us. We're here to help!

Thanks,<br>
{{ config('app.name') }}
@endcomponent
