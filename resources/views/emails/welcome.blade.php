@component('mail::message')
# Welcome to Our Service

Hi {{ $user->name }},

Thank you for registering!

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
