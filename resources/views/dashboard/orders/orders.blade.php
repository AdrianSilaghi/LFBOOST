@extends('layouts.dashboard')
@section('content')

@inject('user','App\User')
@inject('post','App\Post')
@inject('carbon','Carbon\Carbon')

<div class="contianer">
    <div class="row">
        <div class="col m-t-50 m-b-50">
           <h3>Manage your orders</h3>
        </div>
    </div>
    
    <div class="row">
        <div class="col">
                <ul class="nav" id="menu">
                        <li class="nav-item" id="link">
                        <a class="nav-link" href="{{route('dashboardOrders')}}">All</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{route('queuedOrders')}}">Pending</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{route('activeOrders')}}">Active</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link disabled" href="{{route('deliveredOrders')}}">Delivered</a>
                        </li>
                        <li class="nav-item">
                                <a class="nav-link" href="{{route('completedOrders')}}">Completed</a>
                        </li>
                      </ul>
                      <hr>

                @include('orderstable')
        </div>
    </div>

    
</div>

@endsection