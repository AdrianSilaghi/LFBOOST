@extends('layouts.payments')
@section('content')


<meta name="priceOfPost" content="{{$post->price + 2}}">
<div class="container" id="payUP">
        <div class="row justify-content-center">
            <div class="col-5 m-t-50 m-b-40">
                    <h2 class="text-muted text-center">Finish Payment</h2>
                    <hr>
                            <div class="card">
                                <div class="card-header text-center">
                                    Summary
                                </div>
                                <div class="card-body">
                                        <ul class="list-inline text-muted">
                                                <li class="list-inline-item">Subtotal</li>
                                                <li class="list-inline-item float-right">${{$post->price}}</li>
                                        </ul>
                                        <ul class="list-inline text-muted">
                                                <li class="list-inline-item">Service Fee <i class="fas fa-question fa-xs" data-toggle="tooltip" data-placement="top" title="This helps us operate our platform and provice 27/7 customer support for your orders."></i></li>
                                                <li class="list-inline-item float-right">$2</li>
                                        </ul>
                                        <hr>
                                        <ul class="list-inline text-muted" style="font-weight:bold;">
                                                <li class="list-inline-item">Total</li>
                                        <li class="list-inline-item float-right">${{$post->price+2}}</li>
                                        </ul>
                                        <ul class="list-inline text-muted" >
                                                <li class="list-inline-item">Delivery Time</li>
                                        <li class="list-inline-item float-right">{{$post->delivery_time}} Days</li>
                                        </ul>
                                </div>
                                <div class="card-footer">
                                    <form method="GET" action="{{route('payWithPaypal',['postID'=>$post->id])}}">
                                        {{csrf_field()}}
                                                <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                  <span class="input-group-text">Notes for the seller:</span>
                                                                </div>
                                                                <textarea class="form-control" name="notesForSeller" id="notesForSeller" rows="4" aria-label="With textarea" required></textarea>
                                                                <input name="postID" value="{{$post->id}}" hidden>
                                                </div>
                                                <small class="form-text text-muted">
                                                        Please provide some notes (indications) for the seller.
                                                </small>

                                        <div class="div card-header text-center">
                                            Payment
                                        </div>
                                        <div class="text-center">
                                        <button type="submit" id="payWithPaypal" class="mt-3" >
                                            <img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/PP_logo_h_100x26.png" class="mb-3" alt="PayPal Logo">
                                            <br>
                                            <img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/cc-badges-ppmcvdam.png" alt="Credit Card Badges">
                                        </button>
                                        </div>
                                    </form>

                                </div>

            </div>
        </div>
</div>
</div>


@endsection