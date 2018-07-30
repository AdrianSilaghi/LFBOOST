@extends('layouts.dashboard')
@section('content')
@php
$user = Auth::user();
@endphp

<div class="container">
  <div class="row">
    <div class="col-sm-md m-t-20">
        <div class="card" id="profileCard">
            <div class="card-body" style="width:350px;">
                <div class="row">
                        <div class="col" id="onlineBtns">
                                @if($user->isOnline())
                                <span class="btn btn-outline-success btn-sm" id="onlineBtn">Online</span>
                                @else
                                <span class="btn btn-outline-dark btn-sm">Offline</span>
                                @endif
                        <div class="text-center">
                            <img src="{{asset("uploads/avatars/$user->avatar")}}" style="width:150px; height:150px;border-radius:50%;">
                        </div>
                    <h5 class="card-title text-center m-t-15">{{$user->name}}</h5>
                    <p class="small text-muted text-center" style="">
                            @if(is_null($user->short_description))
                            "You don't have any short description."
                            @else
                            "{{$user->short_description}}"
                            @endif
                    </p>
                    </div>
                    
                </div>  
                <div class="row">
                <div class="col">
                  
                </div>  
                </div> 
                <div class="row">
                    <div class="col">
                         
                    </div>
                </div>  
            </div>
        </div>
        
    </div>
    <div class="col">

    </div>
    </div>
  </div>

@endsection