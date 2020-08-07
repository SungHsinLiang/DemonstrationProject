@component('mail::message')
# 測試 Email
<br>
訂單下定成功
<br>
<br>
訂單內容請至查詢訂單頁面查詢
<br>

@component('mail::button', ['url' => 'http://128.199.229.169/orders'])
查詢訂單
@endcomponent

<br>
Thanks,
<br>
{{ config('app.name') }}
@endcomponent