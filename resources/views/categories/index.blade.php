@extends('layouts.home')
@section('content')
<div class="col">
    <div class="d-flex justify-content-center m-t-20">
            <h1 class="" style="font-weight:bold;">{{$categories->name}}</h1>
    </div>
    <div class="d-flex justify-content-center">
        <div class="form-text text-muted">
                {{$categories->description}}
        </div>
    </div>
    <hr>
    <div class="d-flex">
        <div class="col-3">
            <ul class="nav flex-column">
                    <li class="nav-item">
                    <p style="font-weight:600;">{{$categories->name}}</p>
                    <hr>
                    </li>
                    @foreach($subcat as $sc)
                    <li class="nav-item">
                    <a href="" class="nav-link text-muted">{{$sc->name}}</a>
                    </li>
                    @endforeach
                  </ul>
            </div>
            <div class="col">
                    
                @foreach($subcat as $sc)
                  <div class="d-inline-flex m-b-20 m-r-75">
                        <div class="card" style="width: 18rem;">
                            <a href="{{route('showPostByCat',[$categories->name,$sc->name])}}">
                                <h5 class="card-header text-center">{{$sc->name}}</h5>
                                <div class="card-body d-flex justify-content-center">
                        <img class="card-img text-muted" src="https://lfboost.com/images/lol/{{$sc->img}}"  style="width:128px;height:128px;" alt="Card image">
                        </div>  
                        <div class="card-footer text-center">
                        <span id="desc" class="text-muted">{{$sc->description}}</span>
                        </div>
                            </a>
                        </div>       
                </div> 
                
                @endforeach
                
            </div>
        
    </div>
</div>
@endsection