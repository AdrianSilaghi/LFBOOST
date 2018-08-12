@extends('layouts.home')

@section('content')

<div class="container">
    <div class="flex">
            <div class="flex">
                    <div class="py-2 px-2">
                        <p class="text-grey-darkest text-3xl">Manage Posts</p>
                    </div>
            </div>
    </div>
    <div class="flex-1">
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
                @if($post->verified)
                <button class="btn btn-success btn-sm" disabled>Verified</button>
                @else
                <button class="btn btn-warning btn-sm" disabled>Needs Approval</button>
                @endif
            </td>
            <td>
            <a role="button" href="{{route('showReviewPost',['id'=>$post->id])}}" class="btn btn-info btn-sm" href="">Review Post</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
</div>

@endsection