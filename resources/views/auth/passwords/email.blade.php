@extends('layouts.app')

@section('content')
<div class="w-full max-w-xs">
        @if (session('status'))
        <div role="alert">
                <div class="bg-green text-white font-bold rounded-t px-4 py-2">
                  Success
                </div>
                <div class="border border-t-0  rounded-b bg-white px-4 py-3 text-dark">
                  <p>{{ session('status')}}</p>
                </div>
              </div>
    @endif

        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('password.email') }}">
          {{ csrf_field() }}
            <p class="text-center text-grey text-xs">
                Reset Password
              </p>
          <div class="mb-4">
            <label class="block text-grey-darker text-sm font-bold mb-2" for="username">
              E-mail Adress
            </label>
            <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="email" placeholder="E-mail">
          </div>
          <div class="flex items-center justify-center">
            <button class="bg-green hover:bg-green-dark text-white font-bold w-full py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
              Sign In
            </button>
          </div>
        </form>
    </div>
@endsection
