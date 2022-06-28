@slot('header')
@component('mail::header', ['url' => config('app.url')])
<img src="https://i.ibb.co/6yTVSfP/image-1.png" alt="Estudiar" style="height: 70px;width: 100px;">
@endcomponent
@endslot

@component('mail::message')
# <center>{{ $details['title'] }}</center>
### Status: {{ $details['status'] }}

## {{ $details['dear'] }}
{{ $details['body'] }}

---

## {{ $details['credential_title'] }}
#### {{ $details['email'] }}
#### {{ $details['password'] }}

{{ $details['info_login'] }}

@component('mail::button', ['url' => 'http://localhost:8000'])
Kembali ke Estudiar
@endcomponent

Best regards,<br>
{{ config('app.name') }}
@endcomponent