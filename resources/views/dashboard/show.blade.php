@extends('layouts.dashboard')
@section('content')

<meta name="contactId" content="{{$contact->id}}">

<div class="container" >
    <div class="row justify-content-center">
        <div class="col-8 m-t-20">
                <div class="card">
                        <div class="card-header">
                        <p class="float-left" style="margin-bottom:0rem;">{{$contact->name}}</p>
                        <a href="{{route('dashboard.getContacts')}}"<i class="fas fa-arrow-circle-left m-t-5 fa-lg float-right"></i></a>

                        </div>
                        <div id="chat">
                        <chat v-bind:chats="chats" v-bind:userid="{{auth()->user()->id}}" v-bind:contactid="{{$contact->id}}"></chat>
                        </div>  
                                
                        
                </div>
        </div>
    </div>
</div>
@endsection