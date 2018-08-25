@extends('layouts.settings')
@section('content')

<div class="col">
    <div class="card m-t-20">
        <div class="card-body">
                <form class="form-horizontal" method="POST" action="{{route('updatePaypalEmail')}}">
                    {{ csrf_field() }}
                    <h1 class="display-4" style="font-size:1.5rem">Update your PayPal E-mail</h1>
                    <hr>
                    <div class="form-group{{ $errors->has('old') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Current PayPal E-mail</label>
 
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control form-control-lg" name="email" value="{{$user->paypal_email}}">
 
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                <small id="shortDescHelpBlock" class="form-text text-muted">
                                        This E-mail will be used to withdrawal money. Please update it before trying to withdrawal.
                                        <hr>
                                        Each users must have a unique PayPal E-mail, no two users can have the same withdrawal email.
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
        </div>
    </div>  
</div>

@endsection