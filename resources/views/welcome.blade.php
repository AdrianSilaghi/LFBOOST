@extends('layouts.app')
@section('content')
    @inject('post','App\Post')
<div class="container">
    <div class="row">
        <div class="col">
                <div class="jumbotron jumbotron-fluid" id="jumboPage">
                        <div class="container">
                          <h1 class="display-3">Finding a booster, made easy.</h1>
                          <p class="lead m-t-10">The first freelance marketplace for boosting services has arrived!</p>
                          <ul class="list-inline mt-4">
                            <li class="list-inline-item">
                                <a href="/register" role="button" class="bg-green hover:bg-green-dark text-white font-bold py-3 px-4 rounded" id="hireButton">Hire a booster</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="/register" role="button" class="bg-green hover:bg-green-dark text-white font-bold py-3 px-4 rounded" id="boosterButton">Apply as a booster</a>
                            </li>
                          </ul>
                        </div>
                </div>

        </div>
    </div>
</div>

            <div class="flex-no-wrap sm:flex-wrap md:flex-wrap-reverse lg:flex-no-wrap xl:flex-wrap ">
                <div class="flex flex-row sm:flex-col md:flex-row-reverse lg:flex-col-reverse xl:flex m-t-10">
                    <div class="text-center flex-auto" >
                        <div class="w-full border border-grey-darkest">
                            <div class="text-center px-3 py-2 ">
                                Popular Boosts
                            </div>
                        </div>
                        @if(count($posts) > 0 )
                            @foreach($posts->chunk(5) as $post)
                                <div class="flex-row  flex-row sm:flex-col md:flex-row-reverse lg:flex-col-reverse xl:flex m-t-10" id="mainPage">
                                    @foreach($post as $poo)
                                        <div class="text-center flex-initial sm:flex-col m-r-5 m-l-5 m-t-10" id="PostE">
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
                                                                $countReviews = count($reviews);

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
                                                                    €{{$poo->price}}
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
            <hr>
    <div class="container">
        <div class="row">
            <div class="col">
            <div class="jumbotron jumbotron-fluid" id="liveChatJumbo">
                    <div class="container">
                      <h1 class="display-4"> Live Chat with your Booster</h1>
                      <p class="lead">Your order dashboard includes a real time chat with the booster that is responsible for your order. You can ask him any questions and set up game schedules!</p>
                    </div>
                  </div>
                <hr>
                <div class="jumbotron jumbotron-fluid" id="securityJumbo">
                    <div class="container">
                      <h1 class="display-4">We value Security</h1>
                      <p class="lead">Your order dashboard includes a real time chat with the booster that is responsible for your order. You can ask him any questions and set up game schedules!</p>
                    </div>
                  </div>
                <hr>
                <div class="jumbotron jumbotron-fluid" id="reviewJumbo">
                    <div class="container">
                      <h1 class="display-4">Review system</h1>
                      <p class="lead">Our 5-Star and Review system is essential to LFBOOST.It’s where buyers and sellers can rate their experience after working with each other. </p>
                    </div>
                  </div>
                <hr>
        </div>
    </div>
</div>
@endsection

