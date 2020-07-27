@component('mail::message')
# Place an order successfully

<h1>h1 tag Place an order successfully.</h1>

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent