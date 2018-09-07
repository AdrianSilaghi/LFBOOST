@extends('layouts.home')
@section('content')
<div class="container" id="verifyPage">
    <div class="flex-row">
    <div class="flex ml-auto mr-auto">
            <div class="flex-row">
                    <p><span class="font-bold">Post Owner</span>: {{$post->user->name}}</p>
            </div>
    </div>
    <div class="flex mr-auto ml-auto">
        <div class="flex-col">
            <p class="font-bold">Image</p>
            <img class="card-img-top" src="{{asset("uploads/posts/$post->image")}}" alt="Card image cap">
            <p class="font-bold">Title</p>
            <p>{{$post->title}}</p>
            <hr>
            <p class="font-bold">Categories/Subcat</p>
            <p>{{$post->cat_name}} / {{$post->subcat_name}}</p>
            <hr>
            <p class="font-bold">Details of Payment</p>
            <hr>
            <p class="font-semibold">Price Description</p>
            <p>{!!$post->price_description!!}</p>
            <p class="font-semibold">Price</p>
            <p>{{$post->price}}</p>
            <p class="font-semibold">Delivery Time</p>
            <p>{{$post->delivery_time}}</p>
            <hr>
            <p class="font-bold">Body</p>
            <p>{!!$post->body!!}</p>
            <hr>
            <p class="font-semibold">FAQ</p>

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
                    <hr>
    </div>


    <div class="flex ml-auto mr-auto">

        <form>
        <label class="block text-grey-darker text-sm font-bold mb-2" for="modification">
                If Posts Needs Modifications Type Them Here.
        </label>
        <textarea class="form-control" name="modification" id="modification"></textarea>
        
        <div class="flex-row mt-2">
            <input id="post_id" value="{{$post->id}}" hidden>
            <input id="user_id" value="{{$post->user->id}}" hidden>
            <button class="btn btn-success btn-lg" type="button" id="verifyPost">Verifiy</button>
            <button class="btn btn-danger btn-lg" type="button" id="denyPost">Deny</button>
        </div>
        </form>
    </div>
</div>
</div>
@endsection