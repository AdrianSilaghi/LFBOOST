@extends('layouts.app')
@section('content')

@inject('USER','App\User')
@inject('carbon','Carbon\Carbon')
@inject('order,'App\Order)


<div class="container m-t-20">
    <div class="row justify-content-center">
        <div class="col-6">
            {{-- title+img --}}
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
                    @php
                    $numberOfOrders = $order->where('post_id',$post->id)->where('queued','1')->get();
                    @endphp

                    @if(count($numberOfOrders)>0)
                        <small><span class="text-muted float-right">Orders in queue:{{count($numberOfOrders)}}</span></small>
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
                    <div class="text-center">
                <img class="card-img-top" id="bigImg" src="{{asset("uploads/posts/big$post->image")}}" alt="Card image cap">
                    </div>
                    </div>
            </div>
            {{-- body --}}
            <div class="card m-t-20">
                <div class="card-body">
                    <h5>About this boost</h5>
                    <hr>
                    <p class="card-text">
                        {!!$post->body!!}
                    </p>
                    <hr>
                </div>
            </div>
            {{-- faq --}}
            <div class="card m-t-20">
                <div class="card-body">
                    <h5>Frequently Asked Questions</h5>
                </div>
                
                    @for($i=0;$i<count($qa);$i++)
                    <div class="accordion" id="accordionExample{{$i}}">
                            <div class="card">
                            <div class="card-header" id="headingOne{{$i}}">
                                <h5 class="mb-0">
                                <button class="btn btn-link btn-block float-right text-muted" type="button" data-toggle="collapse" data-target="#collapseOne{{$i}}" aria-expanded="true" aria-controls="collapseOne">
                                  <span class="float-left" style="color:#555;">{{$qa[$i]->question}}</span>    <i class="fas fa-angle-down float-right"></i>
                                  </button>
                                </h5>
                              </div>
                          
                            <div id="collapseOne{{$i}}" class="collapse" aria-labelledby="headingOne{{$i}}" data-parent="#accordionExample{{$i}}">
                                <div class="card-body">
                                    <div class="col">
                                            {{$qa[$i]->answer}}
                                    </div>
                                  
                                </div>
                              </div>
                            </div>
                    </div>
                    @endfor

                    
            </div>

            <div class="card m-t-20">
                <div class="card-header">

                        @if($raiting)
                        <small><span class="text-muted">
                        @if($countReviews <= 1) 
                        {{$countReviews}} Review
                        @else
                        {{$countReviews}} Reviews
                        @endif   
                        </span></small>

                        @for($i=0;$i<$raiting;$i++)
                        <small><i class="fas fa-star" style="color:#EDB867;"></i></small>
                        @endfor
                        <small><span style="color:#EDB867">{{$raiting}}</span></small>
                        
                    @else
                        
                    @endif
                </div>
                <div class="card-body" id="comments">
                    @foreach($reviews as $review)
                    @php
                        $userId = $review->user_id;
                        $reviewUser = $user->where('id',$userId)->first();
                        $created_at = new $carbon($review->created_at);
                        $rate = $review->raiting;
                    @endphp

                    <div class="card m-t-10" id="comment">
                        <div class="card-body">
                            <div class="flex flex-col">
                                <div class="flex items-center">
                                        <img class="w-10 h-10 rounded-full mr-4" src="https://lfboost.com/uploads/avatars/{{$reviewUser->avatar}}" alt="Avatar of {{$reviewUser->name}}">
                                        <div class="text-sm">
                                          <p class="text-black leading-none">
                                              {{$reviewUser->name}}
                                              @if($review->raiting)
                                                @for($i=0;$i<$rate;$i++)
                                                <small><i class="fas fa-star" style="color:#EDB867;"></i></small>
                                                @endfor
                                                <small><span style="color:#EDB867">{{$rate}}</span></small>
                                            @else
                                                
                                            @endif
                                         </p>
                                          <p class="text-grey-dark">{{$created_at->toFormattedDateString()}}</p>
                                        </div>
                                </div>
                                <div class="flex">
                                    <div class="text-sm ml-16 mt-2">
                                        <p class="text-black leading-none">
                                            {{$review->comment}}
                                        </p>
                                    </div>
                                </div>
                           </div>
                        </div>
                    </div>    
                    @endforeach

                    <button class="btn btn-outline-success btn-block m-t-10" id="loadMore" type="button">Show More</button>
                </div>

            </div>
            @foreach($tags as $tag)
                <button class="btn btn-outline-dark btn-sm m-t-10" disabled="disabled">{{$tag->name}}</button>
            @endforeach
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                        <p class="h5">Basic</p>
                        <hr>
                    <div class="row">
                           <div class="col-9">     
                                <p class="card-text">{!!$post->price_description!!}</p>
                            <ul class="list-inline">
                                <li class="list-inline-item text-muted"><i class="far fa-clock"></i></li>
                                <li class="list-inline-item text-muted" style="font-weight:700;">{{$post->price}} Days Delivery</li>
                            </ul>
                        </div>
                        <div class="col">
                           <p class="card-text text-muted" style="font-size:1.4rem;">${{$post->price}}</p>     
                        </div>
                    </div>
                    <hr>
                <a role="button" href="{{route('payment.oveview',['id'=>$post])}}" class="btn btn-success btn-lg btn-block" style="font-weight:600;">Continue (${{$post->price}})</a>
                </div>
            </div>
            <div class="card m-t-20" id="profileCard">
                    <div class="card-body" style="width:350px">
                        <div class="row">
                                <div class="col" id="onlineBtns">
                                        @if($user->isOnline())
                                        <span class="btn btn-outline-success btn-sm" id="onlineBtn">Online</span>
                                        @else
                                        <span class="btn btn-outline-dark btn-sm">Offline</span>
                                        @endif
                                            <a href="{{route('show.user.slug',[$user->slug])}}">
                                <div class="text-center">
                                    <img src="{{asset("uploads/avatars/$user->avatar")}}" style="width:150px; height:150px;border-radius:50%;">
                                </div>
                                            </a>
                                            <a href="{{route('show.user.slug',[$user->slug])}}">
                            <h5 class="card-title text-center m-t-15">{{$user->name}}</h5>
                                            </a>
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
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                </li>
                                <li class="list-inline-item">
                                    <p class="">From</p>
                                </li>
                                <li class="list-inline-item float-right">
                                        <p class="text-muted">{{$user->country}}</p>
                                </li>
                            </ul>
                            <ul class="list-inline">
                                    <li class="list-inline-item">
                                            <i class="fas fa-user"></i>
                                    </li>
                                    <li class="list-inline-item">
                                        <p class="">Memeber Since</p>
                                    </li>
                                    <li class="list-inline-item float-right">
                                            <p class="text-muted">{{$user->created_at->diffForHumans()}}</p>
                                    </li>
                                </ul>
                        </div>
                    </div>      
                    </div>
                </div
                <div class="card">
                        <div class="card m-t-10">
                                <div class="card-body" style="width:350px">
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="card-title">Description</h6>
                                            <hr>
                                            @if(is_null($user->description))
                                            <p class="text-muted" style="font-size:0.80rem;"> You don't have any description.</p>
                                            @else
                                            <p class="card-text">
                                                {{$user->description}}
                                            </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                        </div>
                </div>

        </div>
    </div>
</div>
@endsection