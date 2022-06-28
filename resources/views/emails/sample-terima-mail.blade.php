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
##### Email: {{ $details['email'] }}
##### Password: {{ $details['password'] }}

#### NB: {{ $details['info_login'] }}

@component('mail::button', ['url' => 'http://localhost:8000/mentor/login'])
Login Sekarang
@endcomponent

Best regards,<br>
{{ config('app.name') }}
@endcomponent