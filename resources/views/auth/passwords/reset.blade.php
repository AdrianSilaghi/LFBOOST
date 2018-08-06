@extends('layouts.app')

@section('content')

<div class="w-full max-w-xs" id="registerValidation"     >
        <form class="bg-white rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('password.request') }}">
          {{ csrf_field() }}
          <input type="hidden" name="token" value="{{ $token }}">
            <p class="text-center text-2xl mb-2 text-grey text-xs">
                Reset Password
          <div class="mb-4" {{ $errors->has('password') ? ' has-error' : '' }}>
            <label class="block text-grey-darker text-sm font-bold mb-2" for="e-mail">
              E-mail
            </label>
            <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" autocomplete="email" type="email" placeholder="E-mail">
            @if ($errors->has('name'))
            <span class="help-block">
                    <p class="text-red text-xs italic">{{ $errors->first('email') }}</p>
            </span>
            @endif
        </div>
          <div class="mb-6" {{ $errors->has('password') ? ' has-error' : '' }}>
            <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
              Password
            </label>
            <input class="appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3 leading-tight focus:outline-none focus:shadow-outline" name="password" id="password" autocomplete="new-password" type="password" placeholder="********">
            @if ($errors->has('name'))
            <span class="help-block">
                    <p class="text-red text-xs italic">{{ $errors->first('password') }}</p>
            </span>
            @endif
        </div>
          <div class="mb-6" {{ $errors->has('password_confimration') ? ' has-error' : '' }}>
              <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
                Password Confirmation
              </label>
              <input class="appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3 leading-tight focus:outline-none focus:shadow-outline" name="password_confirmation" id="password_confirmation" type="password" autocomplete="new-password" placeholder="********">
              @if ($errors->has('name'))
              <span class="help-block">
                      <p class="text-red text-xs italic">{{ $errors->first('password_confirmation') }}</p>
              </span>
              @endif
            </div>
          <input type="hidden" name=" ip" value="{{request()->ip()}}">
          <div class="flex items-center justify-center">
            <button class="bg-green hover:bg-green-dark w-full text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
              Reset Password
            </button>
          </div>
        </form>
    </div>
@endsection
