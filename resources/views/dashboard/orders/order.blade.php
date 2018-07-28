@extends('layouts.dashboardid')
@section('content')
@inject('carbon','Carbon\Carbon')
@php
$createdAt = $order->createdAt;
$days = $order->delivery_time;
$dueOn = $carbon->parse($createdAt)->addDays($days);
$deliveredAt = $carbon->parse($order->deliveredAt);

@endphp
@if($order->buyer_id == auth()->user()->id)
<div class="container">
    <div class="row">
        <div class="col">
        <h3 class="m-t-50">
            Order #{{$order->transaction_id}} 
            @if($order->queued==true)
                        <button type="button" class="btn btn-warning btn-sm" disabled>Queued</button>
                        @endif

                        @if($order->progress==true)
                        <button type="button" class="btn btn-info btn-sm" disabled>Active</button>
                        @endif

                        @if($order->pending==true)
                        <button type="button" class="btn btn-primary btn-sm" disabled="disabled">Delivered</button>
                        @endif

                        @if($order->completed==true)
                        <button type="button" class="btn btn-success btn-sm" disabled="disabled">Completed</button>
                        @endif
        </h3>
        <hr>
        <div class="row justify-content-center">
            <div class="col-5">
                <div class="card">
                    <div class="card-header text-center">
                        Details of the order
                    </div>
                    <div class="card-body">
                            <div class="d-flex flex-column">
                                    <ul class="list-inline">
                                            <li class="list-inline-item float-left">Order #ID</li>
                                            <li class="list-inline-item float-right text-muted" style="font-weight:bold;">{{$order->transaction_id}}</li> 
                                    </ul>
                                    <ul class="list-inline">
                                            <li class="list-inline-item float-left">Seller Name</li>
                                            <li class="list-inline-item float-right text-muted" style="font-weight:bold;">
                                            <a href="{{route('show.user.slug',[$boost->user->slug])}}">{{$seller->name}}</a>
                                            </li> 
                                    </ul>
                                    <ul class="list-inline">
                                            <li class="list-inline-item float-left">Due on</li>
                                            <li class="list-inline-item float-right text-muted" style="font-weight:bold;">{{$dueOn->toFormattedDateString()}}</li> 
                                    </ul>
                                    <ul class="list-inline">
                                            <li class="list-inline-item float-left">Delivered On</li>
                                            <li class="list-inline-item float-right text-muted" style="font-weight:bold;">
                                                @if($order->deliveredAt == null)
                                                    This order hasn't been delivered yet.
                                                @else
                                                    {{$deliveredAt->toFormattedDateString()}}
                                                @endif
                                            </li> 
                                    </ul>
                                    <ul class="list-inline">
                                            <li class="list-inline-item float-left">Boost</li>
                                            <li class="list-inline-item float-right text-muted" style="font-weight:bold;">
                                            <a href="{{route('showWithName',[$boost->user->name,$boost->slug])}}">{{$boost->title}}</a>
                                            </li> 
                                    </ul>
                                    <ul class="list-inline">
                                        <li class="list-inline-item float-left">Category</li>
                                        <li class="list-inline-item float-right text-muted">
                                        {{$boost->cat_name}}</a>
                                        </li> 
                                    </ul>
                                        <ul class="list-inline">
                                            <li class="list-inline-item float-left">Subcategory</li>
                                            <li class="list-inline-item float-right text-muted">
                                            {{$boost->subcat_name}}</a>
                                            </li> 
                                    </ul>
                                        <p>Notes from the seller:</p>
                                        <hr>
                                        <p class="" >{{$boost->requirements}}</p>
                            </div>
                            
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header text-center">
                        Control Panel
                    </div>
                    <div class="card-body">
                                    @if($order->queued==true)
                                    <small class="form-text text-muted m-b-20 text-center">
                                            Order is Queued. Waiting for seller to accept it!
                                            <hr>
                                            Once the order is Active you will be able to communicate with the seller trough our system.
                                            <hr>
                                            A new conversation will appear in the Inbox (Dashboard).
                                     </small>
                                    @endif
                                     @if($order->completed==true)
                                        <h6 class="form-text text-muted text-center">Thank you for the review!</h6>
                                        <small class="form-text text-muted m-b-20 text-center">
                                            <hr>
                                                Thanks for choosing us.
                                         </small>
                                     @endif
                                     @if($order->pending == true)
                                     <small class="form-text text-muted m-b-20">
                                           Mark the order as complete & leave a review!
                                    </small>
                                    <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-outline-success btn-block btn-lg">Mark as complete</button>
                                    @include('dashboard.orders.reviewmodal')
                                    <small class="form-text text-muted">
                                            If the seller has delivered the service please mark the order as complete. If you do not reply in 3 days the order will be marked automaticaly.
                                    </small>
                                    @else
                                    @if($order->progress==true)
                                    <small class="form-text text-muted">
                                            Once the order has been delivered a button will appear and you can mark it as complete. 
                                            
                                    </small>
                                    <hr>
                                    <small class="form-text text-muted">
                                            Also you will have an option to leave a review which is very important for the seller and for us.
                                    </small>
                                    @endif
                                    @endif
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@else
<div class="container">
        <div class="row">
            <div class="col">
            <h3 class="m-t-50">
                Order #{{$order->transaction_id}} 
                @if($order->queued==true)
                            <button type="button" class="btn btn-warning btn-sm" disabled>Queued</button>
                            @endif
    
                            @if($order->progress==true)
                            <button type="button" class="btn btn-info btn-sm" disabled>Active</button>
                            @endif
    
                            @if($order->pending==true)
                            <button type="button" class="btn btn-primary btn-sm" disabled="disabled">Delivered</button>
                            @endif
    
                            @if($order->completed==true)
                            <button type="button" class="btn btn-success btn-sm" disabled="disabled">Completed</button>
                            @endif
            </h3>
            <hr>
            <div class="row justify-content-center">
                <div class="col-5">
                    <div class="card">
                        <div class="card-header text-center">
                            Details of the order
                        </div>
                        <div class="card-body">
                                <div class="d-flex flex-column">
                                        <ul class="list-inline">
                                                <li class="list-inline-item float-left">Order #ID</li>
                                                <li class="list-inline-item float-right text-muted" style="font-weight:bold;">{{$order->transaction_id}}</li> 
                                        </ul>
                                        <ul class="list-inline">
                                                <li class="list-inline-item float-left">Buyer Name</li>
                                                <li class="list-inline-item float-right text-muted" style="font-weight:bold;">
                                                <a href="{{route('show.user.slug',[$boost->user->slug])}}">{{$buyer->name}}</a>
                                                </li> 
                                        </ul>
                                        <ul class="list-inline">
                                                <li class="list-inline-item float-left">Due on</li>
                                                <li class="list-inline-item float-right text-muted" style="font-weight:bold;">{{$dueOn->toFormattedDateString()}}</li> 
                                        </ul>
                                        <ul class="list-inline">
                                                <li class="list-inline-item float-left">Delivered On</li>
                                                <li class="list-inline-item float-right text-muted" style="font-weight:bold;">
                                                    @if($order->deliveredAt == null)
                                                        This order hasn't been delivered yet.
                                                    @else
                                                        {{$deliveredAt->toFormattedDateString()}}
                                                    @endif
                                                </li> 
                                        </ul>
                                        <ul class="list-inline">
                                                <li class="list-inline-item float-left">Boost</li>
                                                <li class="list-inline-item float-right text-muted" style="font-weight:bold;">
                                                <a href="{{route('showWithName',[$boost->user->name,$boost->slug])}}">{{$boost->title}}</a>
                                                </li> 
                                        </ul>
                                        <ul class="list-inline">
                                            <li class="list-inline-item float-left">Category</li>
                                            <li class="list-inline-item float-right text-muted">
                                            {{$boost->cat_name}}</a>
                                            </li> 
                                        </ul>
                                            <ul class="list-inline">
                                                <li class="list-inline-item float-left">Subcategory</li>
                                                <li class="list-inline-item float-right text-muted">
                                                {{$boost->subcat_name}}</a>
                                                </li> 
                                        </ul>
                                            <p>Notes from the buyer:</p>
                                            <hr>
                                            <p class="" >{{$order->notes}}</p>
                                </div>
                                
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-header text-center">
                            Control Panel
                        </div>
                        <div class="card-body">
                                        @if($order->queued==true)
                                        <small class="form-text text-muted">
                                            New orders are Queued. Waiting for you the seller to accept them!
                                        </small>
                                        <hr>
                                        <button id="accetButton" class="btn btn-info btn-lg btn-block">Accept order</button>
                                         <input type="hidden" id="transaction_id" value="{{$order->transaction_id}}" name="transaction_id">
                                        <small class="form-text text-muted">
                                                After accepting the order , it will go in Active mode, where you can start working on it.
                                        </small>
                                        <hr>
                                    
                                        
                                        @endif
                                         @if($order->completed==true)
                                         <small class="form-text text-muted">
                                               The order has been marked as complete by the buyer.
                                               <hr>
                                               And they also left a review on your orders page.
                                        </small>
                                        <hr>
                                        <small class="form-text text-muted m-t-20">
                                            <span style="font-weight:bold;">${{$priceforSeller}} </span> have been added to your acccount and the 14 days clearence period starts now!
                                        </small>
                                        @endif
                                        @if($order->pending == true)
                                         <small class="form-text text-muted">The order has been delivered.
                                                <hr> 
                                            Waiting for buyers confirmation.
                                            <hr>
                                            If the buyer doesn't reply within 3 days, the order will be marked as complete and the clearence process will begin.
                                        
                                        </small>
                                        @else
                                        @if($order->progress==true)
                                        <small class="form-text text-muted">
                                               The order is Active. Please use our system to communicate with the buyer!
                                               <hr>
                                               Go to Dashboard -> Inbox to see the new conversation that has been created.
                                        </small>
                                        <hr>
                                        <button id="" data-toggle="modal" data-target="#deliverModal" class="btn btn-primary btn-lg btn-block">Deliver order</button>
                                        @include('dashboard.orders.delivermodal')
                                        <small class="form-text text-muted">
                                                Once you finish your order you must deliver it.Otherwise it will not count towards your account balance.
                                                <hr>
                                                Once you click, a form will apear, you will need to upload 1-2 screenshots from while u were performing the service for confirmation.
                                        </small>
                                        
                                        @endif
                                        @endif
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
@endif
@endsection