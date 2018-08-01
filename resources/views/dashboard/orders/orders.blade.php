@extends('layouts.dashboard')
@section('content')

@inject('user','App\User')
@inject('post','App\Post')
@inject('carbon','Carbon\Carbon')

@if(count($orders))
<div class="contianer">
    <div class="row">
        <div class="col m-t-50 m-b-50">
           <h1 class="display-4" style="font-size:2.5rem;">Manage Your Orders</h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col">
                <ul class="nav nav-tabs">
                        <li class="nav-item" id="link">
                        <a class="nav-link" href="{{route('dashboardOrders')}}">All</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{route('dashboardOrders',['type'=>'queued'])}}">Pending</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{route('dashboardOrders',['type'=>'progress'])}}">Active</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{route('dashboardOrders',['type'=>'pending'])}}">Delivered</a>
                        </li>
                        <li class="nav-item">
                                <a class="nav-link" href="{{route('dashboardOrders',['type'=>'completed'])}}">Completed</a>
                        </li>
                      </ul>
                      <hr>
                    
                @include('orderstable')
        </div>
    </div>    
</div>
@else
<div class="contianer">
        <div class="row">
            <div class="col m-t-50 m-b-50">
               <h1 class="display-4" style="font-size:2.5rem;">Manage Your Orders</h1>
            </div>
        </div>
        
        <div class="row">
            <div class="col">
                    <ul class="nav nav-tabs">
                            <li class="nav-item" id="link">
                            <a class="nav-link" href="{{route('dashboardOrders')}}">All</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="{{route('dashboardOrders',['type'=>'queued'])}}">Pending</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="{{route('dashboardOrders',['type'=>'progress'])}}">Active</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="{{route('dashboardOrders',['type'=>'pending'])}}">Delivered</a>
                            </li>
                            <li class="nav-item">
                                    <a class="nav-link" href="{{route('dashboardOrders',['type'=>'completed'])}}">Completed</a>
                            </li>
                          </ul>
                          <hr>
                        
            </div>
        </div>    
    </div>
<div class="container">
    <div class="row justify-content-center">
            <div class="col text-center m-t-100">
                            <span class="text-muted">
                                            <i class="fas fa-briefcase fa-7x"></i>
                                            <h1 class="display-4">Nothing to see here yet!</h1>
                                            <small class="form-text text-muted">Please check again after you have recived an order!</small>
                            </span>
            </div>
    </div>
</div>
@endif

@endsection