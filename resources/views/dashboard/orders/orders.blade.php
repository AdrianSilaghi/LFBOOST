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
                                <a class="nav-link" href="{{route('completedOrders',['type'=>'completed'])}}">Completed</a>
                        </li>
                      </ul>
                      <hr>

                @include('orderstable')
        </div>
    </div>

    
</div>

@endsection