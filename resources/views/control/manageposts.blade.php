@extends('layouts.app')

@section('content')

<div class="container">
    <table class="table" id="managePosts">
        <thead>
          <tr>
            <th scope="col">Post ID</th>
            <th scope="col">Post Owner</th>
            <th scope="col">Verified</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            @php
            
            @endphp 
          <tr>
            <td>
                {{$post->id}}
            </td>
            <td>
                {{$post->user->name}}
            </td>
            <td>
                {{$post->verified}}
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
</div>

@endsection