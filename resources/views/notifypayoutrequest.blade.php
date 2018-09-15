@component('mail::message')

A new payout request has been done by user : {{$user->name}} with email adress {{$user->email}} and paypal adress of {{$user->paypal_email}}

Available funds : {{$user->availalbeWithdrawal}} eur.
<br>
Pending funds:
@foreach($user->pendingmoney as $pm)
    {{$pm->ammount}} eur
@endforeach
<br>
The ammount requested is {{$ammount}} eur.

Look carefully into the orders page and stuff.

Thanks,<br>
{{ config('app.name') }}
@endcomponent