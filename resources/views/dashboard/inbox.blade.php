@extends('layouts.dashboard')
@section('content')

<div class="contianer">
    <div class="row">
            <div class="col-2 m-t-20 ">
                    @forelse($contacts as $contact)
            <a href="{{route('dashboard.showChat',['id'=>$contact->id])}}">
                    <div class="card m-t-5">
                            <div class="card-body">
                            <p class="text-muted">{{$contact->name}}</p>
                            
                            </div>
                          </div>
                        </a>
                    @empty
                    You have no contacts;
                    @endforelse
                </div>
    </div>

</div>

@endsection

