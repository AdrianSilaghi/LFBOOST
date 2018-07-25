@extends('layouts.home')
@section('content')
<div class="d-flex">
    <div class="col">
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

<div class="d-flex">
        <div class="col"></div>
        <div class="col">
            <div class="card">
                <div class="card-body" style="padding:1rem;">
                       <h1 class="display-4" style="font-size:1.8rem;margin-bottom:0rem;">Newest arrivals</h1>
                       
                </div>
            </div>
                @if(count($posts) > 0 )
                    @foreach($posts->chunk(4) as $post)
                    <div class="d-inline-flex flex-fill" id="mainPage">
                        @foreach($post as $poo)
                                <div class="d-sm-inline-flex flex-wrap flex-fill flex-column m-r-5 m-l-5 m-t-10" id="PostE">
                                        <div class="card">
                                                <img class="card-img-top" src="{{asset("uploads/posts/$poo->image")}}/" alt="Card image cap">
                                                <div class="card-body">
                                                  <ul class="list-inline">
                                                      <li class="list-inline-item">
                                                            <img src="http://localhost/uploads/avatars/{{$poo->user->avatar }}" style="width:25px; height:25px;border-radius:50%;"> 
                                                      </li>
                                                      <li class="list-inline-item">
                                                            <a href="{{route('show.user.slug',[$poo->user->slug])}}"><p class="h6">{{$poo->user->name}}</p></a>
                                                      </li>
                                                  </ul>
                                                  @if(strlen($poo->title)>30)
                                                    <a href="{{route('showWithName',[$poo->user->name,$poo->slug])}}"><p style="font-size:1rem;height:35px;">
                                                    
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
                    
                            

                    
                @endif
        </div>
        <div class="col"></div>
</div>

<div class="d-flex">
        <div class="col"></div>
        <div class="col m-t-25">
            <div class="card">
                <div class="card-body" style="padding:1rem;">
                       <h1 class="display-4" style="font-size:1.8rem;margin-bottom:0rem;">Popular ones</h1>
                       
                </div>
            </div>
                @if(count($popular) > 0 )
                    @foreach($popular->chunk(4) as $post)
                    <div class="d-inline-flex flex-fill" id="mainPage">
                        @foreach($post as $poo)
                                <div class="d-sm-inline-flex flex-wrap flex-fill flex-column m-r-5 m-l-5 m-t-10" id="PostE">
                                        <div class="card">
                                                <img class="card-img-top" src="{{asset("uploads/posts/$poo->image")}}/" alt="Card image cap">
                                                <div class="card-body">
                                                  <ul class="list-inline">
                                                      <li class="list-inline-item">
                                                            <img src="http://localhost/uploads/avatars/{{$poo->user->avatar }}" style="width:25px; height:25px;border-radius:50%;"> 
                                                      </li>
                                                      <li class="list-inline-item">
                                                            <a href="{{route('show.user.slug',[$poo->user->slug])}}"><p class="h6">{{$poo->user->name}}</p></a>
                                                      </li>
                                                  </ul>
                                                  @if(strlen($poo->title)>30)
                                                    <a href="{{route('showWithName',[$poo->user->name,$poo->slug])}}"><p style="font-size:1rem;height:35px;">
                                                    
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
                    
                            

                    
                @endif
        </div>
        <div class="col"></div>
</div>
@endsection
