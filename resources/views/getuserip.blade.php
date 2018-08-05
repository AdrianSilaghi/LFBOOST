@extends('layouts.app')
@section('content')
{{$ip}}

<hr>

@foreach($data as $da)
    {{$da}}

@endforeach

@endsection