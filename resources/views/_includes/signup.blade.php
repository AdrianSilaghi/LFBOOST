<div class="row justify-content-center">
  <div class="col">
      <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Join LFBOOST</h5>
            <form class="form-signin"method="POST" action="{{ route('register') }}">
              {{ csrf_field() }}
              {{-- <div class="form-label-group">
                          <input type="text" id="inputUsername1" autocomplete="username" class="form-control" name="name" placeholder="Username" required autofocus>
                          <label for="inputUsername1">Username</label>
              </div>
              <div class="form-label-group">
                <input type="email" id="inputEmail2" autocomplete="email" class="form-control" name="email" placeholder="Email address" required autofocus>
                <label for="inputEmail2">Email address</label>
              </div>
  
              <div class="form-label-group">
                <input type="password" id="inputPassword3" autocomplete="new-password" name="password" class="form-control" placeholder="Password" requiredautofocus>
                <label for="inputPassword3">Password</label>
              </div>
  
              <div class="form-label-group">
                      <input type="password" id="inputPassword2" autocomplete="new-password" name="password_confirmation" class="form-control" placeholder="Password" required autofocus>
                      <label for="inputPassword2">Password</label>
              </div>
  
            
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
              <hr class="my-4">
              <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign in with Google</button>
              <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</button> --}}
            </form>
          </div>
        </div>
  
  </div>
</div>

