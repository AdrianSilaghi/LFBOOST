@extends('layouts.app')

@section('content')
<div class="w-full max-w-xs mt-4">
    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <p class="text-center text-grey text-xs">
            Log In to LFBOOST
          </p>
      <div class="mb-4">
          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    
        <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
          E-mail
        </label>
        <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" autocomplete="email" type="email" placeholder="E-mail">
        @if ($errors->has('email'))
        <span class="help-block">
            <span class="text-red text-xs italic">{{ $errors->first('email') }}</span>
        </span>
        @endif

      </div>
      </div>
      <div class="mb-6">
          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
          Password
        </label>
        <input class="appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3 leading-tight focus:outline-none focus:shadow-outline" name="password" id="password" autocomplete="current-password" type="password" placeholder="********">
        @if ($errors->has('password'))
        <span class="help-block">
            <span class="text-red text-xs italic">{{ $errors->first('password') }}</span>
        </span>
        @endif
      </div>
      </div>
      
      <div class="flex items-center justify-between">
        <button class="bg-green hover:bg-green-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          Sign In
        </button>
        <a class="inline-block align-baseline font-bold text-sm text-green hover:text-blue-darker" href="{{ route('password.request') }}">
          Forgot Password?
        </a>
      </div>
      <div class="form-check mt-2">
        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

        <label class="form-check-label text-xs" for="remember">
            {{ __('Remember Me') }}
        </label>
    </div>
    </form>
</div>
@endsection
