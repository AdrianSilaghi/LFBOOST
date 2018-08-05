@extends('layouts.app')
@section('content')
{{$ip}}

<hr>

@php
$x=0;
foreach($data as $dat){
   return $x = $dat;
}
@endphp
{{$x}}
@endsection