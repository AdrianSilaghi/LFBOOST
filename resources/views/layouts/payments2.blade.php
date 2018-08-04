<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
        {!! SEO::generate(true) !!} 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="userId" content="{{ Auth::check() ? Auth::user()->id : '' }}">
    
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
   {{ csrf_field() }}
    <title>LFBOOST | Looking for a boost? | Marketplace for boosting services | Fortnite , World of Warcraft , League of Legends and much more!</title>

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
    <link rel="stylesheet" href="{{asset('css/smart_wizard.css')}}">
    <link rel="stylesheet" href="{{asset('css/smart_wizard_theme_arrows.css')}}">
    <link rel="stylesheet" href="{{asset('css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('css/parsley.css')}}">
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('css/fontawesome-stars.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div>
        @include('_includes.nav.paymentnav')
        @include('_includes.messages')
        <div class="container">
            <div class="row justify-content-center">
                @yield('content') 
            </div>
        </div>
    </div>
</body>
    <!-- Scripts -->
    <!-- development version, includes helpful console warnings -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>

    <script src="{{asset('js/select2.js')}}"></script>
    <script src="{{asset('js/algolia.js')}}"></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script src="{{asset('js/dropzone.js')}}"></script>
    <script src="{{asset('js/jquery.smartWizard.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
    <script src="{{asset('js/bootstrap-tagsinput.js')}}"></script>
    <script src="{{asset('js/jquery.barrating.min.js')}}"></script>
    <script src="https://js.braintreegateway.com/web/dropin/1.11.0/js/dropin.min.js"></script>
    <!-- Load PayPal's checkout.js Library. -->
<script src="https://www.paypalobjects.com/api/checkout.js" data-version-4 log-level="warn"></script>

<!-- Load the client component. -->
<script src="https://js.braintreegateway.com/web/3.34.1/js/client.min.js"></script>

<!-- Load the PayPal Checkout component. -->
<script src="https://js.braintreegateway.com/web/3.34.1/js/paypal-checkout.min.js"></script>
    
</html>