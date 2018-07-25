<nav class="navbar navbar-expand-md navbar-light bg-light">
  <div class="container">
    @guest
    <a class="navbar-brand m-b-5" href="{{route('home')}}">
            <img src="{{asset('images/logo@0,75x.png')}}" alt="">
          </a>
    @else
    <a class="navbar-brand m-b-5" href="{{route('home')}}">
      <img src="{{asset('images/logo@0,75x.png')}}" alt="">
    </a>
    @endguest
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
            <div class="aa-input-container" id="aa-input-container">
                    <input type="search" id="aa-search-input" class="aa-input-search"
                            placeholder="Search for Boosts" name="search" autocomplete="off" />
                
                    <svg class="aa-input-icon" viewBox="654 -372 1664 1664">
                        <path d="M1806,332c0-123.3-43.8-228.8-131.5-316.5C1586.8-72.2,1481.3-116,1358-116s-228.8,43.8-316.5,131.5  C953.8,103.2,910,208.7,910,332s43.8,228.8,131.5,316.5C1129.2,736.2,1234.7,780,1358,780s228.8-43.8,316.5-131.5  C1762.2,560.8,1806,455.3,1806,332z M2318,1164c0,34.7-12.7,64.7-38,90s-55.3,38-90,38c-36,0-66-12.7-90-38l-343-342  c-119.3,82.7-252.3,124-399,124c-95.3,0-186.5-18.5-273.5-55.5s-162-87-225-150s-113-138-150-225S654,427.3,654,332  s18.5-186.5,55.5-273.5s87-162,150-225s138-113,225-150S1262.7-372,1358-372s186.5,18.5,273.5,55.5s162,87,225,150s113,138,150,225  S2062,236.7,2062,332c0,146.7-41.3,279.7-124,399l343,343C2305.7,1098.7,2318,1128.7,2318,1164z" />
                    </svg>
                </div>
      </ul>
      @guest
      <ul class="navbar-nav ml-auto">
          <a class="nav-link" href="#">Become a seller</a>
          <a class="nav-link" data-toggle="modal" data-target="#exampleModalCenter" href="{{route('login')}}">Sign in</a>

          <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content" style="width:400px;">
                  <div class="modal-header">
                    
                    <h5 class="modal-title" id="exampleModalCenterTitle">Login to <span style="font-weight:bold;">LFBOOST</span></h5>

                   

                  </div>
                  
                  <div class="modal-body">
                    <div class="col">
                      <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                          {{ csrf_field() }}
  
                          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                              <label for="email" class="col control-label">E-Mail Address</label>
  
                              <div class="col">
                                  <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
  
                                  @if ($errors->has('email'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('email') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          
                              <label for="password" class="col-md-4 control-label">Password</label>
  
                              <div class="col">
                                  <input id="password" type="password" class="form-control" name="password" required>
  
                                  @if ($errors->has('password'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('password') }}</strong>
                                      </span>
                                  @endif
                              </div>
                              
                          </div>
                          
                         
                          <hr>
                          <div class="form-group">
                           
                              <div class="row">
                                    <div class="col"><button type="submit" class="btn btn-success">
                                            Continue
                                        </button></div>
                                    <div class="col m-t-5"><div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> <span style="font-size:0.80rem;">Remember Me</span> 
                                            </label>
                                        </div></div>
                              </div>
                                  
                              
                          </div>
                          <hr>
                          <div class="form-group" style="text-align:center;">
                              <div class="col">
                                  <a class="btn btn-link" href="{{ route('password.request') }}">
                                    <span style="font-size:0.8rem;">Forgot Your Password?</span> 
                                </a>
                            </div>
                                  
                              
                            </div>
                          </div>
                          
                      </form>
                  </div>
                  
                  </div>
                </div>
              </div>
            </div>
            <button class="btn btn-outline-success my-2 my-sm-0" data-toggle="modal" data-target="#registerModal">Join</button>

         
          
      </ul>
      @else
      <ul class="navbar-nav">
        <a class="m-t-10 m-r-10" href="{{route('home')}}" data-placement="bottom" title="Dashboard" id="dashboardIcon"><span><i class="fas fa-chart-pie fa-lg"></i></span></a>
        <li class="nav-item dropdown mr-2">
            
       
          <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="http://localhost/uploads/avatars/{{Auth::user()->avatar}}" style="width:32px; height:32px; position:aboslute; top: 10px; left: 10px; border-radius:50%">    
              Hey {{Auth::user()->name}}
          </a>
          
          <div class="dropdown-menu" aria-labelledby="navbarDropdown" id="topBarDropDown">
            <a href="{{route('show.user.slug',[Auth::user()->slug])}}" class="dropdown-item"> <span><i class="fas fa-user-circle"></i></span> Profile</a>
            <a class="dropdown-item" href="{{route('home')}}"> <span><i class="fas fa-tachometer-alt"></i></span> Dashboard</a>
            <a href="{{route('account')}}"class="dropdown-item"> <span><i class="fas fa-cog"></i></span> Settings</a>
            <hr></hr>
            <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"> <span><i class="fas fa-sign-out-alt"></i></span> Log Out</a>
          </div>
        </li>
      </ul>
        @endguest
        @include('_includes.forms.logout')
    </div>
    </div>
  </nav>
 
  

