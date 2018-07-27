@extends('layouts.dashboard')
@section('content')

<div class="contianer">
    <div class="row">
        <div class="col">
           <h1 class="text-center">Chat app</h1>
           <message :messages="messages"></message>
           <sent-message v-on:messagesent="addMessage" :user="{{Auth()->user()}}"></sent-message>
        </div>
    </div>
</div>

@endsection

