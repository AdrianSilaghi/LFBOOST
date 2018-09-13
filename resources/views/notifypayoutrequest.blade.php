@component('mail::message')

A new payout request has been done.


{{$url}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent