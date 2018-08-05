@component('mail::message')

<h3>Welcome to Looking For Boost {{$user->name}}</h3>

<h4>Please verify your e-mail: {{$user->email}} with the button below!</h4>


@component('mail::button', ['url'=> 'http://lfboostdev/user/verify/'. $user->verifyUser->token , 'color' => 'green'])
Verify your E-Mail Now.
@endcomponent
<br>
{{ config('app.name') }}
@endcomponent