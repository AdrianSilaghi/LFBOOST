@extends('layouts.app')
@section('content')
{{$ip}}

<hr>
@foreach($position as $po)
{{$po}}
@endforeach
@endsection