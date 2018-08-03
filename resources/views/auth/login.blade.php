@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-5">
            
<div class="card card-signin my-5">
        <div class="card-body">
          <h5 class="card-title text-center">Sign In</h5>
          <form class="form-signin"  method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="form-label-group">
              <input type="email" id="inputEmail44" autocomplete="email" class="form-control" name="email" placeholder="Email address" required autofocus>
              <label for="inputEmail44">Email address</label>
            </div>

            <div class="form-label-group">
              <input type="password" id="inputPassword44" autocomplete="current-password" name="password" class="form-control" placeholder="Password" required>
              <label for="inputPassword44">Password</label>
            </div>

            <div class="custom-control custom-checkbox mb-3">
              <input type="checkbox" name="remember" class="custom-control-input" id="customCheck14">
              <label class="custom-control-label" for="customCheck1">Remember password</label>
            </div>
            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
            <hr class="my-4">
            <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign in with Google</button>
            
          </form>
        </div>
      </div>

        </div>
    </div>
</div>
@endsection
