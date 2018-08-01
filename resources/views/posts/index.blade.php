@extends('layouts.app')

@section('content')
<div class="col" style="width:100%;">
        <div class="d-flex justify-content-start m-t-20">
        <h1 class="" style="font-weight:600;">{{$subcat->name}}</h1>
        </div>
        <div class="d-flex justify-content-start">
            <div class="form-text text-muted">
                    {{$subcat->description}}
            </div>
        </div>
        <hr>
        <div class="d-flex flex-fill">
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
<div class="d-flex">
<div class="col">
        @if(count($posts) > 0 )
            @foreach($posts->chunk(4    ) as $post)
            <div class="d-inline-flex flex-fill m-t-50" id="mainPage">
                @foreach($post as $poo)
                        <div class="d-sm-inline-flex flex-wrap flex-fill flex-column m-r-5" id="PostE">
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
    
                        
                                                 <ul class="list-inline">
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
                                                            <small><span class="text-muted">({{round($countReviews,1)}})</span></small>
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
            
                <div class="d-flex justify-content-center mr-auto ml-auto m-t-20">
                    
                            {{ $posts->links() }}
                    
                </div>
                    
            
                    
            
            
        @endif
</div>
</div>
@endsection