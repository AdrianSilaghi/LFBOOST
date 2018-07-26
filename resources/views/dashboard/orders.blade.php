@extends('layouts.dashboard')
@section('content')
@inject('user','App\User')
@inject('post','App\Post')
@inject('carbon','Carbon\Carbon')

<div class="contianer">
    <div class="row">
        <div class="col">
           <h3>Manage your orders</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-dark">
                <thead>
                  <tr>
                    <th scope="col">Order Number</th>
                    <th scope="col">Seller</th>
                    <th scope="col">Buyer</th>
                    <th scope="col">Order Name</th>
                    <th class="col">Due on</th>
                    <th class="col">Delivered On</th>
                    <th class="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    @php
                    $seller = $user->where('id',$order->seller_id)->first();
                    $buyer = $user->where('id',$order->buyer_id)->first();
                    $postInfo = $post->where('id',$order->post_id)->first();
                    @endphp 
                  <tr>
                    <th>{{$order->transaction_id}}</th>
                    <td>{{$seller->name}}</td>
                    <td>{{$buyer->name}}</td>
                    <td>{{$postInfo->title}}</td>
                    <td></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>

@endsection