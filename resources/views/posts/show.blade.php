@extends('layouts.app')

@section('content')
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
            {{-- body --}}
            <div class="card m-t-20">
                <div class="card-body">
                    <h5>About this boost</h5>
                    <hr>
                    <p class="card-text">
                        {{$post->body}}
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
                <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ route('addReview',[$post->id]) }}">
                                {{ csrf_field() }}
                        
                                <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Comment</label>
                        
                                    
                                    <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3"></textarea>
                        
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    
                                </div>
                                <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                        <label for="example" class="col-md-4 control-label">Raiting</label>

                                        <select id="example" name="raiting">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                        </select>
                                
                                    <input type="hidden" name="post_id" value="{{$post->id}}">            
                                            
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-outline-success" type="submit">Add</button>
                                </div>
                        </form>
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
                                <p class="card-text">{{$post->price_description}}</p>
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