@extends('layouts.home')
@section('content')
@inject('post','App\Post')
@inject('recentlyViewed','App\RecentlyViewed')
@php
$recentlyViewedPosts = $recentlyViewed->groupBy('post_id')->where('user_id',auth()->user()->id)->orderBy('created_at','desc')->take(5)->get();
@endphp


<div class="relative flex" >

    <div class="w-1/4 relative mr-2 m-t-20">
        <div class="sticky pin-t py-3">
            <div class="h-auto w-full border border-grey-dark mb-3">
                    <div class="px-3 py-3">
                       <p class="font-semibold text-grey-darkest "> Hello, {{auth()->user()->name}}</p>
                        <p class="mt-2 text-sm">Helpful links:</p>
                        <ul class="list-reset mt-2">
                        <li class="text-sm">
                            <a href="{{route('howToFind')}}" class="text-green hover:text-green-light" >
                                Buying
                            </a>
                        </li>
                        <li class="text-sm">
                                <a href="{{route('becomeSeller')}}" class="text-green hover:text-green-light">
                                    Selling
                                </a>
                        </li>
                        <li class="text-sm">
                                <a href="{{route('trustsafety')}}" class="text-green hover:text-green-light">
                                    Trust & Safety
                                </a>
                            </li>    
                    </ul>
                    </div>
            </div>
            <div class="h-auto w-full border border-grey-dark mb-3">
                    <div class="px-3 py-3">
                            <p class="font-semibold text-grey-darkest">Popular Games</p>
                    </div>
                    <div class="px-3 py-1 mb-1">
                            <a href="{{route('showSpecificCat','World of Warcraft')}}" class="border-2 border-green py-1 px-1 text-sm rounded text-green hover:bg-green hover:text-white">World of Warcraft</a>
                    </div>
                    <div class="px-3 py-1 mb-1">
                            <a href="{{route('showSpecificCat','League of Legends')}}" class="border-2 border-green py-1 px-1 text-sm rounded text-green hover:bg-green hover:text-white">League of Legends</a>
                    </div>
                    <div class="px-3 py-1 mb-1">
                            <a href="{{route('showSpecificCat','Fortnite')}}" class="border-2 border-green py-1 px-1 text-sm rounded text-green hover:bg-green hover:text-white">Fortnite</a>
                    </div>
            </div>
            @if($recentlyViewedPosts != null)
            <div class="h-auto w-full border border-grey-dark">
                    <div class="px-3 py-3">
                        <p class="font-semibold text-grey-darkest">Recently Viewed</p>
                    </div>
                    
                    @foreach($recentlyViewedPosts as $un)
                    @php
                    $boost = $post->find($un->post_id);
                    $boostName = $boost->title;
                    @endphp
                    
                    <a href="{{route('showWithName',[$boost->user->name,$boost->slug])}}" class="text-grey-darkest hover:text-green"> 
                    <div class="flex px-3 mb-2">
                        <div class="flex-1">
                                <img src="{{asset("uploads/posts/$boost->image")}}" width="85px" height="60px" alt="{{$boost->title}}">
                        </div>
                        <div class="flex-1 ml-1">
                                @if(strlen($boostName)>25)
                                <p class=" text-sm leading-tight">{{substr($boostName,0,30)}}...</p>
                                @else
                                <p class=" text-sm leading-tight">{{$boostName}}</p>
                                @endif
                        </div>
                    </div>
                    </a>

                    @endforeach
                    

                    
            </div>
            @endif
        </div>
    </div>

    <div class="w-auto">
<div class="flex-row  flex-row sm:flex-col md:flex-row-reverse lg:flex-col-reverse xl:flex m-t-20">
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
                    <div class="w-full border border-grey-darkest">
                       <div class="px-3 py-2">
                            <p class="text-xl font-semibold font-sans text-grey-darkest">Feautured</p>
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
                <div class="w-full border border-grey-darkest">
                        <div class="px-3 py-2 ">
                             <p class="text-xl font-semibold font-sans text-grey-darkest">Newest Arrivals</p>
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
                <div class="w-full border border-grey-darkest">
                        <div class="px-3 py-2 ">
                             <p class="text-xl font-semibold font-sans text-grey-darkest">Popular Ones</p>
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
</div>
</div>  
@endsection
