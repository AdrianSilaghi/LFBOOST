@extends('layouts.app')
@section('content')
<div class="col-md-6 m-l-100 m-t-100">
    <div class="card">
        <div class="card-body"></div>
<form class="form-horizontal" method="POST" action="{!! action('UsersController@update', ['id' => $user->id]) !!}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-sm control-label">Name</label>

            <div class="col">
                <input id="name" type="text" class="form-control" name="name" value="{{$user->name}}" required autofocus>

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <label for="email" class="col-sm control-label">Email</label>
    
                <div class="col">
                    <input id="email" type="email" class="form-control" name="email" value="{{$user->email}}" required autofocus>
    
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        <input type="hidden" name="_method" value="put" />
        <div class="form-group">
            <div class="col-sm-4 m-t-20">
                <button type="submit" class="btn btn-primary">
                    Update
                </button>
            </div>
        </div> 
    </form>
    </div>
</div>
@endsection