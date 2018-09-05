@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm m-t-20">
        <div class="card" id="profileCard">
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

        <div class="card m-t-10">
                <div class="card-body" style="width:350px">
                    <div class="row">
                        <div class="col">
                            <h6 class="card-title">Languages</h6>
                            <hr>
                            <p class="card-text">
                                @if($userLang->count()==0)
                                <p class="text-muted" style="font-size:0.80rem;">You don't have any languages selected</p> 
                                @endif
                                @foreach($userLang as $lang)
                                <ul class="list-inline" style="-webkit-margin-after:0;">
                                        <li class="list-inline-item">{{$lang->name}}</li>
                                        <li class="list-inline-item">-</li>
                                        <li class="list-inline-item text-muted">{{$lang->pivot->level}}</li> 
                                </ul> 
                                      @endforeach
                            </p>
                        </div>
                    </div>
                </div>
        </div>

        <div class="card m-t-10">
                <div class="card-body" style="width:350px">
                    <div class="row">
                        <div class="col">
                            <h6 class="card-title">Games</h6>
                            <hr>
                            <p class="card-text">
                                @if($userGames->count()==0)
                                <p class="text-muted" style="font-size:0.80rem;">You dont have any games selected</p> 
                                @endif
                                    <ul class="list-unstyled">
                                    @foreach($userGames as $lang)
                                            <li class="list-inline-item">{{$lang->name}}</li>
                                      @endforeach
                                    </ul> 
                            </p>
                        </div>
                    </div>
                </div>
        </div>
        <div class="card m-t-10">
                <div class="card-body" style="width:350px">
                    <div class="row">
                        <div class="col">
                            <h6 class="card-title">Achivements</h6>
                            <hr>
                            <p class="card-text">
                                @if($userAchiv->count()==0)
                                <p class="text-muted" style="font-size:0.80rem;">You don't have any games selected</p> 
                                @endif
                                @foreach($userAchiv as $achiv)
                                <ul class="list-inline" style="-webkit-margin-after:0;">
                                    <li class="list-inline-item">{{$achiv->pivot->game_name}}</li>
                                    <li class="list-inline-item">-</li>
                                    <li class="list-inline-item text-muted">{{$achiv->name}}</li>
                                </ul>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
        </div>  
    </div>
    </div>

    <div class="col">
        <div class="flex-no-wrap sm:flex-wrap md:flex-wrap-reverse lg:flex-no-wrap xl:flex-wrap ">
            <div class="flex flex-row sm:flex-col md:flex-row-reverse lg:flex-col-reverse xl:flex m-t-20">
                <div class="flex-auto">
                    <div class="w-full border border-grey-darkest">
                        <div class="px-3 py-2 ">
                            <p class="text-xl font-semibold font-sans text-grey-darkest">{{$user->name}}'s Boosts</p>
                        </div>
                    </div>
                    @if(count($user->posts->where('verified',true)) > 0 )
                        @foreach($user->posts->where('verified',true)->chunk(3) as $post)
                            <div class="flex-row  flex-row sm:flex-col md:flex-row-reverse lg:flex-col-reverse xl:flex m-t-10" id="mainPage">
                                @foreach($post as $poo)
                                    <div class="flex-initial sm:flex-col m-r-5 m-l-5 m-t-10" id="PostE">
                                        <div class="card">
                                            <img class="card-img-top" src="{{asset("uploads/posts/$poo->image")}}" alt="Card image cap">
                                            <div class="card-body">

                                                <div class="inline-flex" class="">
                                                    <div class="flex-auto self-center">
                                                        <img src="https://lfboost.com/uploads/avatars/{{$poo->user->avatar}}" style="width:25px; height:25px;border-radius:50%;">
                                                    </div>
                                                    <div class="flex-col self-center m-l-5" style="line-height:1;">
                                                        <a href="{{route('show.user.slug',[$poo->user->slug])}}"><small style="font-weight:500" class="">{{$poo->user->name}}</small></a>
                                                        @if($poo->user->level == 0 )
                                                            <small class="text-muted" style="display:block;font-weight:500">
                                                                Basic Seller
                                                            </small>
                                                        @endif
                                                        @if($poo->user->level == 1)
                                                            <small class="text-muted" style="display:block;font-weight:500">
                                                                Level One Booster
                                                            </small>
                                                        @endif

                                                        @if($poo->user->level == 2)
                                                            <small class="text-muted" style="display:block;font-weight:500">
                                                                Level Two Booster
                                                            </small>
                                                        @endif

                                                        @if($poo->user->level == 3)
                                                            <small class="text-yellow-dark" style="display:block;font-weight:500">
                                                                Top Rated Booster
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="inline-flex mt-2">
                                                    <div class="w-full h-10">
                                                        @if(strlen($poo->title)>30)
                                                            <a href="{{route('showWithName',[$poo->user->name,$poo->slug])}}">

                                                                <p>{{substr($poo->title,0,30)}}... </p>

                                                            </a>
                                                        @else
                                                            <a href="{{route('showWithName',[$poo->user->name,$poo->slug])}}">

                                                                <p>    {{substr($poo->title,0,30)}} </p>

                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                                @php
                                                    $reviews = $poo->review;

                                                        if(count($reviews)==0){
                                                            $avg = 0;
                                                            $countReviews = 0;
                                                        }else{
                                                        foreach($reviews as $r){
                                                                $a[] = $r->raiting;

                                                            }

                                                            $avg = round(array_sum($a)/count($a),1);
                                                            $countReviews = count($a);

                                                        }
                                                @endphp
                                                <div class="flex h-8">
                                                    <div class="w-full">
                                                        @if($avg)
                                                            <small><i class="fas fa-star" style="color:#EDB867;"></i></small>

                                                            <small><span style="color:#EDB867">{{$avg}}</span></small>
                                                            <small><span class="text-muted">({{$countReviews}})</span></small>
                                                        @endif

                                                        @if($poo->feautured == true)

                                                            <small class="float-right text-green-dark">Feautured</small>

                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="flex">
                                                    <div class="w-1/2">
                                                    </div>
                                                    <div class="w-1/2">

                                                        <p class="card-text text-muted float-right">
                                                                <span style="font-size:0.75rem;">
                                                                PRICE:
                                                                </span>
                                                            <span style="font-weight:500;font-size:1.1rem;">
                                                                    ${{$poo->price}}
                                                                </span>
                                                        </p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                @endforeach

                            </div>
                        @endforeach




                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection