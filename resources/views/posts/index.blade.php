@extends('layouts.app')

@section('content')
<div class="flex flex-col sm:flex-col md:flex-row-reverse lg:flex-col xl:flex items-start" style="justify-content:flex-start !important;">
    <div class="flex-auto" style="width:970px;">
        <div class="flex-auto m-t-20">
        <h1 class="" style="font-weight:600;">{{$subcat->name}}</h1>
        </div>
        <div class="flex-auto">
            <div class="form-text text-muted">
                    {{$subcat->description}}
            </div>
        </div>
        <hr>
        <div class="flex-auto">
                <div class="dropdown">
                        <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Sort by:
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                            <a class="dropdown-item" href="{{route('showPostByPrice',[$categories,$subcat->name,'desc'])}}">Price</a>
                            <a class="dropdown-item" href="{{route('showPostByViews',[$categories,$subcat->name,'hottest'])}}">Popular</a>
                            <a class="dropdown-item" href="{{route('showPostsByDate',[$categories,$subcat->name,'desc'])}}">Newest</a> 
                        </div>
                      </div>
        </div>
        <hr>
        </div>
</div>


<div class="flex-no-wrap sm:flex-wrap md:flex-wrap-reverse lg:flex-no-wrap xl:flex-wrap ">
        <div class="flex flex-row sm:flex-col md:flex-row-reverse lg:flex-col-reverse xl:flex m-t-10">
    <div class="flex-auto">
    @if(count($posts) > 0 )
        @foreach($posts->chunk(4) as $post)
        <div class="flex-row  flex-row sm:flex-col md:flex-row-reverse lg:flex-col-reverse xl:flex m-t-10" id="mainPage">
            @foreach($post as $poo)
                    <div class="flex-initial m-r-5 m-l-5 m-t-10" id="PostE">
                            <div class="card">
                                    <img class="card-img-top" src="{{asset("uploads/posts/$poo->image")}}" alt="Card image cap">
                                    <div class="card-body">
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <img src="https://lfboost.com/uploads/avatars/{{$poo->user->avatar}}" style="width:25px; height:25px;border-radius:50%;"> 
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

                    
                                                <ul class="list-inline" id="priceList">
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
                                                    
                                                    <small><i class="fas fa-star" style="color:#EDB867;"></i></small>
                                                    
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
        
                

        
    @endif
</div>        
</div>
</div>
@endsection