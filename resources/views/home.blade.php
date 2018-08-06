@extends('layouts.home')
@section('content')

<div class="flex-row  flex-row sm:flex-col md:flex-row-reverse lg:flex-col-reverse xl:flex m-t-10">
    <div class="flex-auto">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                      <img class="d-block w-100" src="{{asset('images/1st slide.png')}}" alt="First slide">
                      </div>
                      <div class="carousel-item">
                        <img class="d-block w-100" src="{{asset('images/2st slide.png')}}" alt="Second slide">
                      </div>
                    </div>
                  </div>    
    </div>
</div>
<div class="flex-no-wrap sm:flex-wrap md:flex-wrap-reverse lg:flex-no-wrap xl:flex-wrap ">
        <div class="flex flex-row sm:flex-col md:flex-row-reverse lg:flex-col-reverse xl:flex m-t-10">
                <div class="flex-auto">
                    <div class="card">
                        <div class="card-body" style="padding:1rem;">
                               <h1 class="display-4" style="font-size:1.8rem;margin-bottom:0rem;">Feautured</h1>
                               
                        </div>
                    </div>
                        @if(count($posts) > 0 )
                        @php
                        $feautured = $posts->where('feautured',true)->take(4);
                        @endphp
                            @foreach($feautured->chunk(4) as $post)
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
<div class="flex-no-wrap sm:flex-wrap md:flex-wrap-reverse lg:flex-no-wrap xl:flex-wrap ">
<div class="flex flex-row sm:flex-col md:flex-row-reverse lg:flex-col-reverse xl:flex m-t-10">
        <div class="flex-auto">
            <div class="card">
                <div class="card-body" style="padding:1rem;">
                       <h1 class="display-4" style="font-size:1.8rem;margin-bottom:0rem;">Newest arrivals</h1>
                       
                </div>
            </div>
                @if(count($posts) > 0 )
                    @foreach($posts->chunk(4) as $post)
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
<div class="flex-no-wrap sm:flex-wrap md:flex-wrap-reverse lg:flex-no-wrap xl:flex-wrap ">
<div class="flex-row  flex-row sm:flex-col md:flex-row-reverse lg:flex-col-reverse xl:flex m-t-10">
        <div class="flex-auto">
            <div class="card m-t-10">
                <div class="card-body" style="padding:1rem;">
                       <h1 class="display-4" style="font-size:1.8rem;margin-bottom:0rem;">Popular ones</h1>
                       
                </div>
            </div>
                @if(count($popular) > 0 )
                    @foreach($popular->chunk(4) as $post)
                    <div class="flex-row  flex-row sm:flex-col md:flex-row-reverse lg:flex-col-reverse xl:flex m-t-10" id="mainPage">
                        @foreach($post as $poo)
                                <div class="flex-initial sm:flex-col m-r-5 m-l-5 m-t-10" id="PostE">
                                        <div class="card">   
                                            <img  src="{{asset("uploads/posts/$poo->image")}}" alt="Card image cap">
                                                <div class="card-body">
                                                        <div class="inline-flex" class="">
                                                                <div class="flex-auto self-center">
                                                                        <img src="https://lfboost.com/uploads/avatars/{{$poo->user->avatar}}" style="width:25px; height:25px;border-radius:50%;"> 
                                                                </div>
                                                                <div class="flex-col self-center m-l-5" style="line-height:1;">
                                                                        <a href="{{route('show.user.slug',[$poo->user->slug])}}"><small style="font-weight:500" class="">{{$poo->user->name}}</small></a>
                                                                        @if($poo->user->level == 0 )
        
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
@endsection
