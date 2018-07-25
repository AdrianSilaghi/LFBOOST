@extends('layouts.settings')
@section('content')

<div class="col">
    <div class="card m-t-20">
        <div class="card-body">
                <form class="form-horizontal" method="POST" action="{{route('email.update')}}">
                    {{ csrf_field() }}
                    <h1 class="display-4" style="font-size:1.5rem">Update your email</h1>
                    <hr>
                    <div class="form-group{{ $errors->has('old') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Current E-mail</label>
 
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control form-control-lg" name="email" value="{{$user->email}}">
 
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                <small id="shortDescHelpBlock" class="form-text text-muted">
                                        Your current password.
                                      </small>
                            </div>
                            <hr>
                        </div>
                        <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-outline-success form-control">Update</button>
                                    </div>
                            </div>
                </form>

                <form class="form-horizontal" method="POST" action="{{route('password.update')}}">
                        {{csrf_field()}}
                    
                        <h1 class="display-4" style="font-size:1.5rem">Update your password</h1>
                        <hr>
                        <div class="form-group{{ $errors->has('old') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Old Password</label>
     
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control form-control-lg" name="old">
     
                                    @if ($errors->has('old'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('old') }}</strong>
                                        </span>
                                    @endif
                                    <small id="shortDescHelpBlock" class="form-text text-muted">
                                            Your current password.
                                          </small>
                                </div>
                            </div>
     <hr>
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">Password</label>
     
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control form-control-lg" name="password">
     
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                        <small id="shortDescHelpBlock" class="form-text text-muted">
                                                Must be at least 6 characters long.
                                              </small>
                                    </div>
                                </div>
     <hr>
                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
     
                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation">
     
                                        @if ($errors->has('password_confirmation'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                        @endif
                                        <small id="shortDescHelpBlock" class="form-text text-muted">
                                                Confirmation.
                                              </small>
                                    </div>
                                </div>
     <hr>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-outline-success form-control">Update</button>
                                    </div>
                            </div>
    
                </form>
        </div>
    </div>
</div>

@endsection