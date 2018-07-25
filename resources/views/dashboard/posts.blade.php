@extends('layouts.home')
@section('content')

<div class="col-sm m-l-100 m-t-100">
    
    <table class="table is-bordered">
        <thead>
            <tr>
                <th>
                    Title
                </th>
                <th>
                    Views
                </th>
                <th>
                        Category
                </th>
                <th>
                    Realms
                </th>
                <th>
                        Edit
                </th>
                <th>
                    Delete
                </th>
            </tr>
        </thead>
        <tbody class="has-text-centred">
            @foreach($post as $post)
            @if(Auth::user()->id == $post->user_id)
            <tr>
                <th>
                    {{$post->title}}
                </th>
                <th>
                    {{$post->getUniqueViews()}}
                </th>
                <th>
                        {{$post->category->name}} 
                    </th>
                    <th>
                        {{$post->tags()->value('name')}}
                    </th>
                <th>
                        <a href="/Test_laravel/public/home/posts/{{$post->id}}/edit" class="btn btn-primary"> Edit</a>
                </th>
                <th>
                        {!!Form::open(['action' => ['PostsController@destroy',$post->id],'method' => 'POST'])!!}
                        {{Form::hidden('_method','DELETE')}}
                        {{Form::submit('Delete',['class'=> 'btn btn-danger"'])}}
                        {!!Form::close()!!}
                </th>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>

@endsection