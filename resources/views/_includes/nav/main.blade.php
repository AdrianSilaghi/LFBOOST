<div class="w-4/5  ml-auto mr-auto">
<nav class="navbar navbar-expand-md navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      Menu<span class="navbar-toggler-icon"></span>
    </button>
      
        @guest
        
        <a class="navbar-brand m-b-5" href="{{route('index')}}">
                <img src="{{asset('images/logos/logoGood.png')}}" alt="Logo of LFBOOST">
              </a>
        @else
        <a class="navbar-brand m-b-5" href="{{route('home')}}">
          <img src="{{asset('images/logos/logoGood.png')}}" alt="Logo of LFBOOST">
        </a>
        @endguest
        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
          <div class="flex-none sm:flex-grow md:flex-shrink lg:flex-1 xl:flex-auto">
          <ul class="navbar-nav">
                <div class="aa-input-container" id="aa-input-container">
                        <input type="search" id="aa-search-input" class="aa-input-search"
                                placeholder="Search for Boosts" name="search" autocomplete="off" />
                    
                        <svg class="aa-input-icon" viewBox="654 -372 1664 1664">
                            <path d="M1806,332c0-123.3-43.8-228.8-131.5-316.5C1586.8-72.2,1481.3-116,1358-116s-228.8,43.8-316.5,131.5  C953.8,103.2,910,208.7,910,332s43.8,228.8,131.5,316.5C1129.2,736.2,1234.7,780,1358,780s228.8-43.8,316.5-131.5  C1762.2,560.8,1806,455.3,1806,332z M2318,1164c0,34.7-12.7,64.7-38,90s-55.3,38-90,38c-36,0-66-12.7-90-38l-343-342  c-119.3,82.7-252.3,124-399,124c-95.3,0-186.5-18.5-273.5-55.5s-162-87-225-150s-113-138-150-225S654,427.3,654,332  s18.5-186.5,55.5-273.5s87-162,150-225s138-113,225-150S1262.7-372,1358-372s186.5,18.5,273.5,55.5s162,87,225,150s113,138,150,225  S2062,236.7,2062,332c0,146.7-41.3,279.7-124,399l343,343C2305.7,1098.7,2318,1128.7,2318,1164z" />
                        </svg>
                    </div>
          </ul>
        </div>
      @guest
      <ul class="navbar-nav ml-auto">
      <a class="nav-link" href="{{route('becomeSeller')}}">Become a seller</a>
          

          <a class="nav-link m-r-10" href="/login">Sign In</a>       
                  
            <a role="button" href="/register" class="bg-green hover:bg-green-dark text-white font-bold py-2 px-3 rounded">Join</a>
                     
                 
            

         
          
      </ul>
       
      
      @else
      <ul class="navbar-nav" id="notification">
        <notification v-bind:notifications="notifications"></notification>

        <li class="nav-item">
        <a class="nav-link" href="{{route('dashboard')}}">Dashboard</a>
        </li>
        <li class="nav-item dropdown mr-2">
            
       
          <a class="nav-link dropdown-toggle text-sm" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="https://lfboost.com/uploads/avatars/{{Auth::user()->avatar}}" style="width:32px; height:32px; position:aboslute;left: 10px; border-radius:50%">    
              {{Auth::user()->name}}
          </a>
          
          <div class="dropdown-menu" aria-labelledby="navbarDropdown" id="topBarDropDown">
            <a href="{{route('show.user.slug',[Auth::user()->slug])}}" class="dropdown-item"> <span><i class="fas fa-user-circle"></i></span> Profile</a>
            <a class="dropdown-item" href="{{route('dashboard')}}"> <span><i class="fas fa-tachometer-alt"></i></span> Dashboard</a>
            <a href="{{route('account')}}"class="dropdown-item"> <span><i class="fas fa-cog"></i></span> Settings</a>
            <hr></hr>
            <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"> <span><i class="fas fa-sign-out-alt"></i></span> Log Out</a>
            @include('_includes.forms.logout') 
          </div>
        </li>
      </ul>
        @endguest
        
    </div>
  </nav>
</div>
  

