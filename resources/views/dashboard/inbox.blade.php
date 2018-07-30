@extends('layouts.dashboard')
@section('content')

<div class="contianer">
    <div class="row">

            <div class="col-3 m-t-20"  id="contacts">
                    <div class="card">
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
                    You have no contacts;
                    @endforelse
                </div>
        </div>
        </div>
    </div>

</div>

@endsection

