@component('mail::message')

Hello, <b>{{$user->name}}</b>


<h4>{{$message}}</h4>



@component('mail::button', ['url'=> 'https://lfboost.com/dashboard/order?orderID='. $order->transaction_id , 'color' => 'green'])
    View Order
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent