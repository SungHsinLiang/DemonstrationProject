@component('mail::message')
# 新增帳號成功
@endcomponent

@component('mail::message')
# 新增帳號成功
<br>
請點選下方按鈕啟用帳號

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent