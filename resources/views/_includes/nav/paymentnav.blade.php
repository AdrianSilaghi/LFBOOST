<nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="container justify-content-center">
          @guest
          <a class="navbar-brand m-b-5" href="{{route('home')}}">
                  <img src="{{asset('images/logos/logoFront.png')}}" alt="">
                </a>
          @else
          <a class="navbar-brand m-b-5" href="{{route('home')}}">
            <img src="{{asset('images/logos/logoFront.png')}}" alt="">
          </a>
          @endguest
        </div>
</nav>