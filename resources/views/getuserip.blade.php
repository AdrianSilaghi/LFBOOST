@extends('layouts.app')
@section('content')
{{$ip}}

<hr>
@foreach($data as $dat)
{{$dat}}
@endforeach

@endsection