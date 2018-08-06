@extends('layouts.app')

@section('content')
<div class="w-full max-w-xs">
    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('login') }}">
      {{ csrf_field() }}
        <p class="text-center text-grey text-xs">
            Log In to LFBOOST
          </p>
      <div class="mb-4">
        <label class="block text-grey-darker text-sm font-bold mb-2" for="username">
          E-mail
        </label>
        <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="email" placeholder="E-mail">
      </div>
      <div class="mb-6">
        <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
          Password
        </label>
        <input class="appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3 leading-tight focus:outline-none focus:shadow-outline" name="password" id="password" type="password" placeholder="********">
        
      </div>
      <div class="flex items-center justify-between">
        <button class="bg-green hover:bg-green-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          Sign In
        </button>
        <a class="inline-block align-baseline font-bold text-sm text-green hover:text-blue-darker" href="{{ route('password.request') }}">
          Forgot Password?
        </a>
      </div>
    </form>
</div>
@endsection
