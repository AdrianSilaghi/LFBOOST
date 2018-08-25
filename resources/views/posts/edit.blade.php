@extends('layouts.app')
@section('content')

{!! Form::open(['action' => ['PostsController@update',$post->id], 'method'=>'POST']) !!}
    <div class="columns">
        <div class="column is-7 is-offset-3 m-t-100">
            <div class="card">
                <div class="card-content">   
                    <h1>Edit Post</h1>
                    <form>
                        {{Form::label('title', '',['class' => 'is-size-3'], 'Title')}}
                        
                        {{Form::text('title', $post->title, ['class' => 'input m-b-20', 'placeholder' => 'Title'])}}
                        @if ($errors->has('title'))
                        <p class="help is-danger">{{$errors->first('title')}}</p>
                        @endif
                        {{Form::label('Body', '',['class' => 'is-size-3'], 'Title')}}
                        
                        {{Form::textarea('body', $post->body, ['class' => 'ckeditor', 'type'=>'text', 'placeholder' => 'Body'])}}
                        
                        @if ($errors->has('title'))
                        <p class="help is-danger">{{$errors->first('title')}}</p>
                        @endif
                        {{Form::hidden('_method','PUT')}}
                        {{Form::submit('Submit',['class' =>'button m-t-20'])}}
                    </form>
                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}
@endsection