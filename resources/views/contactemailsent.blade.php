@component('mail::message')

Issue : {{$issue}}
<br>
Name of user: {{$username}}
<br>
Email of user: {{$email}}
<br>

Message:
<br>
<p class="form-text m-b-20">{{$message}}</p>
<br>
{{ config('app.name') }}
@endcomponent