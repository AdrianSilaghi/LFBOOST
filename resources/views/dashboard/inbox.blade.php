@extends('layouts.dashboard')
@section('content')


@if(count($contacts))
<div class="contianer">
    <div class="row">

            <div class="col-sm-lg m-t-20"  id="contacts">
                    <div class="card" style="width:300px;">
                                <div class="card-header">
                                                <h5 class="form-text text-muted">Contacts:</h5>
                                 </div>
        <div class="card-body">
                    @forelse($contacts as $contact)
            <a href="{{route('dashboard.showChat',['id'=>$contact->id])}}">
                        <div class="card m-t-5">
                                <div class="card-header text-center">
                                <p class="text-muted m-t-10 m-l-5" style="font-weight:600;">{{$contact->name}}</p>
                                </div>
                                </div>
                        </a>
                    @empty
                    
                    @endforelse
                </div>
        </div>
        </div>
    </div>

</div>
@else
<div class="container">
                <div class="row justify-content-center">
                        <div class="col text-center m-t-100">
                                        <span class="text-muted">
                                                        <i class="far fa-comments fa-7x"></i>
                                                        <h1 class="display-4">Nothing to see here yet!</h1>
                                                        <small class="form-text text-muted">Please check again after you have recived an order!</small>
                                        </span>
                        </div>
                </div>
            </div>
@endif
@endsection

