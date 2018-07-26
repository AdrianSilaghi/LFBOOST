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
    

            <div class="table-responsive">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Order Number</th>
                    <th scope="col">Seller</th>
                    <th scope="col">Buyer</th>
                    <th scope="col">Order Name</th>
                    <th scope="col">Due on</th>
                    <th scope="col">Delivered On</th>
                    <th scope="col">Status</th>
                    <th scope="col">Mark As</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    @php
                    $seller = $user->where('id',$order->seller_id)->first();
                    $buyer = $user->where('id',$order->buyer_id)->first();
                    $postInfo = $post->where('id',$order->post_id)->first();
                    $createdAt= $post->created_at;
                    $days = $order->delivery_time;
                    $dueOn = $carbon->parse($createdAt)->addDays($days);
                    $dueOn->toFormattedDateString();
                    $deliveredAt = $order->deliveredAt;
                    @endphp 
                  <tr>
                    <th scope="row">{{$order->transaction_id}}</td>
                    <td>{{$seller->name}}</td>
                    <td>{{$buyer->name}}</td>
                    <td>{{$postInfo->title}}</td>
                    <td>{{$dueOn}}</td>    
                    <td>{{$deliveredAt}}</td>
                    <td>None</td>
                    <td></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

    
</div>

@endsection