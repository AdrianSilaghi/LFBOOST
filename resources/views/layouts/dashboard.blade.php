<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
        {!! SEO::generate(true) !!} 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="userId" content="{{ Auth::check() ? Auth::user()->id : '' }}">
    <meta name="userEmail" content="{{ Auth::check() ? Auth::user()->email : '' }}">
    <meta name="userName" content="{{ Auth::check() ? Auth::user()->name : '' }}">
    <meta name="theme-color" content="green">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{ csrf_field() }}
    <title>LFBOOST Dashboard</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-49588686-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-49588686-3');
</script>



    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/select2.css')}}">
    <link rel="stylesheet" href="{{asset('css/algolia.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/smart_wizard.css')}}">
    <link rel="stylesheet" href="{{asset('css/smart_wizard_theme_arrows.css')}}">
    <link rel="stylesheet" href="{{asset('css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('css/fontawesome-stars.css')}}">
    <link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    
</head>
{{-- ss --}}
<body>
    <div>
        @include('_includes.nav.main')
        @include('_includes.nav.dashboardmenu')
        @include('_includes.messages')
        <div class="container">
                @yield('content')
        </div>
        @include('_includes.nav.footer')
    </div>
</body>
    <!-- Scripts -->
    <!-- development version, includes helpful console warnings -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{asset('js/dropzone.js')}}"></script>
    <script src="{{asset('js/algolia.js')}}"></script>
    <script src="{{asset('ck/ckeditor.js')}}"></script>
    <script src="{{asset('js/jquery.barrating.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('js/datatables.min.js')}}"></script>
    <script>
            const userID = $('meta[name="userId"]').attr('content');
            const userName = $('meta[name="userName"]').attr('content');
            const userEmail = $('meta[name="userEmail"]').attr('content');
            (function(d, w, c) {
                w.ChatraID = 'YSqFEXrb3nTuExGf4';
                var s = d.createElement('script');
                w[c] = w[c] || function() {
                    (w[c].q = w[c].q || []).push(arguments);
                };
                s.async = true;
                s.src = 'https://call.chatra.io/chatra.js';
                if (d.head) d.head.appendChild(s);
            })(document, window, 'Chatra');
            window.ChatraIntegration = {
            /* main properties */
            name: userName,
            email: userEmail,
            userId: userID,
        
        };
        </script>
</html>
