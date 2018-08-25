@extends('layouts.home')
@section('content')
<div class="col-md-6 m-l-100 m-t-100">
    <div class="card">
        <div class="card-body"></div>
<form class="form-horizontal" method="POST" action="{!! action('PostsController@update', ['id' => $post->id]) !!}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label for="title" class="col-sm control-label">Title</label>

            <div class="col">
                <input id="title" type="text" class="form-control" name="title" value="{{$post->title}}" required autofocus>

                @if ($errors->has('title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                <label for="title" class="col-md-4 control-label">Body</label>
        <div class="col-sm">
        <div class="input-group">
                <textarea id="body" name="body" value="" class="ckeditor" aria-label="" required autofocus>{{$post->body}}</textarea>
                @if ($errors->has('body'))
                <span class="help-block">
                    <strong>{{ $errors->first('body') }}</strong>
                </span>
            @endif
              </div>
        </div>
        <div class="col">
        <div class="form-group">
                <label for="realms" class="control-label m-t-10">Select category:</label>
                <select class="form-control" id="realms" value="{{$post->category_id}}" name="categories">
                    @foreach($categories as $cat)
                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                </select>
              </div>
        </div>
        <div class="col">
                <div class="form-group">
                        <label for="categories" class="control-label m-t-10">Select realm:</label>
                        <select class="form-control" id="realms" value="{{$post->realm_id}}" name="realm">
                            @foreach($realms as $realm)
                            <option value="{{$realm->id}}">{{$realm->name}}</option>
                            @endforeach
                        </select>
                      </div>
                </div>
                <input type="hidden" name="_method" value="put" />
        <div class="form-group">
            <div class="col-sm-4 m-t-20">
                <button type="submit" class="btn btn-primary">
                    Post
                </button>
            </div>
        </div> 
    </form>
</div>
</div>
</div>


@endsection

