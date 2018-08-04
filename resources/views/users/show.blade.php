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
            <div class="card m-t-20" style="width:720px;">
                    <div class="card-body">
                      <span style="font-weight:bold;font-size:1.2rem;">
                            {{$user->name}}'s Boosts
                      </span>
                    </div>
            </div>
            @foreach($user->posts->chunk(3    ) as $post)
            <div class="d-inline-flex flex-fill m-t-20">
                @foreach($post as $poo)
                        <div class="d-sm-inline-flex flex-wrap flex-fill flex-column m-r-5" id="PostE">
                            <div class="card">
                                    <img class="card-img-top" src="{{asset("uploads/posts/$poo->image")}}" alt="Card image cap">
                                    <div class="card-body">
                                      <ul class="list-inline">
                                          <li class="list-inline-item">
                                                <img src="https://lfboost.com/uploads/avatars/{{$poo->user->avatar }}" style="width:25px; height:25px;border-radius:50%;"> 
                                          </li>
                                          <li class="list-inline-item">
                                                <a href="{{route('show.user.slug',[$poo->user->slug])}}"><p class="h6">{{$poo->user->name}}</p></a>
                                          </li>
                                      </ul>
                                      @if(strlen($poo->title)>30)
                                        <a href="{{route('showWithName',[$poo->user->name,$poo->slug])}}"><p style="font-size:1rem;height:35px;width:195px;">
                                        
                                        {{substr($poo->title,0,30)}}... 
                                       
                                        </p></a>
                                        @else
                                        <a href="{{route('showWithName',[$poo->user->name,$poo->slug])}}"><p  style="font-size:1rem;height:35px;">
                                        
                                            {{substr($poo->title,0,30)}}
                                           
                                        </p></a>
                                        @endif

                    
                                             <ul class="list-inline"  id="priceList">
                                                <li class="list-inline-item">
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
                                                  
                                                  @if($avg)
                                                  @for($i=0;$i<$avg;$i++)
                                                  <small><i class="fas fa-star" style="color:#EDB867;"></i></small>
                                                  @endfor
                                                  <small><span style="color:#EDB867">{{$avg}}</span></small>
                                                  <small><span class="text-muted">({{$countReviews}})</span></small>
                                                  @endif 



                                                </li>
                                                <li class="list-inline-item float-right">
                                                    <p class="card-text text-muted">
                                                        <span style="font-size:0.75rem;">
                                                        PRICE:
                                                        </span>
                                                        <span style="font-weight:500;font-size:1.1rem;">
                                                            ${{$poo->price}}
                                                        </span>
                                                    </p>
                                                </li>
                                            </ul>
                                        
                                    </div>
                            </div>
                            
                    </div>
                    
                @endforeach
                
            </div>
            @endforeach
    </div>
</div>

@endsection