@extends('layouts.dashboard')
@section('content')
<div class="flex">
    <div class="w-full m-t-50">
            <h1 class="display-4" style="font-size:2.5rem;">Manage Your Boosts</h1>
    </div>
</div>
<div class="flex">
        <div class="w-full m-t-50">
                @include('dashboard.mybooststable')
        </div>
    </div>

@endsection