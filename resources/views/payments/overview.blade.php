@extends('layouts.payments2')
@section('content')
<div class="container" id="payUP">
    <div class="row justify-content-center">
        <div class="col m-t-50 text-center">
                <h2 class="text-muted">Overview</h2>
                <hr>
        </div>
    </div>
    <div class="row m-t-50 justify-content-center">
        <div class="col-6">
                <div class="card">
                        <div class="card-body">
                        <h3>{{$post->title}}</h3>
                        @if($raiting)
                            @for($i=0;$i<$raiting;$i++)
                            <small><i class="fas fa-star" style="color:#EDB867;"></i></small>
                            @endfor
                            <small><span style="color:#EDB867">{{$raiting}}</span></small>
                            <small><span class="text-muted">({{$countReviews}})</span></small>
                        @else
                            
                        @endif
                            <hr>
                        <small>
                                <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{route('showSpecificCat',[$post->cat_name])}}">{{$post->cat_name}}</a></li>
                                            <li class="breadcrumb-item"><a href="{{route('showPostByCat',[$post->cat_name,$post->subcat_name])}}">{{$post->subcat_name}}</a></li>
                                        </ol>
                                </nav>
                        </small>
                        <hr>
                        </div>
                    </div>
                    {{-- <div class="card m-t-75" id="paymentDiv">
                            <div class="card-body">
                                    <div id="dropin-container"></div>
                                    <button class="btn btn-outline-success float-right" id="submit-button">Make payment</button>
                            </div>
                        </div>           --}}
        </div>
        <div class="col-4 justify-content-center">
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
                    <a role="button" href="{{route('payment.finish',['id'=>$post,'price'=>$post->price+2])}}" class="btn btn-success btn-block btn-lg" style="color:white;">Order Now</a>
                    <small id="passwordHelpBlock" class="form-text text-muted text-center">
                           You wont be charged yet.
                          </small>

                </div>
            </div>
            <div class="text-center">
                    <img src="{{asset('images/cards1.png')}}" style=" height:auto;" alt="" srcset="">

                    <small>
                           <p style="margin-bottom:0rem;"><i class="fas fa-lock m-r-5" style="color:#00b22d;"></i><span style="color:#00b22d;">SSL</span> SECURED PAYMENT</p>
                            <span class="text-muted"> Your information is protected by 256-bit SSL encryption</span>
                    </small>
            </div>
                
                    
                    
                    
                
                    
                
        </div>
        
    </div>
    
</div>
@endsection