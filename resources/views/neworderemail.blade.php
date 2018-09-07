@component('mail::message')

Hello, {{$user->name}}


<h5>You have a new order!</h5>


@component('mail::button', ['url'=> 'https://lfboost.com/dashboard/order?orderID='. $order->transaction_id , 'color' => 'green'])
    View Order
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent