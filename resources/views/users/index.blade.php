@extends('layouts.home')
@section('content')
<div class="col-sm m-t-100">
<table class="table is-bordered">
    <thead>
        <tr>
            <th>
                #
            </th>
            <th>
                Name
            </th>
            <th>
                    Email
            </th>
            <th>
                Edit
            </th>
        </tr>
    </thead>
    <tbody>
        
            @foreach($user as $user)
        <tr>
            <th>{{$user->id}}</th>
            <th>
                {{$user->name}}
            </th>
            <th>
                {{$user->email}}
            </th>
            <th>
                    <a href="/Test_laravel/public/home/users/{{$user->id}}/edit" class="btn btn-primary">Edit</a>
            </th>
        </tr>

            @endforeach
    </tbody>
</table>
</div>
</div>

@endsection