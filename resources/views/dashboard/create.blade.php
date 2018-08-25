@extends('layouts.home')
@section('content')

<div class="col-md-6 m-l-100 m-t-100">
    <div class="card">
        <div class="card-body">
        <form class="form-horizontal" method="POST" action="{{ route('posts.store') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label for="title" class="col-sm control-label">Title</label>

            <div class="col">
                <input id="title" type="text" class="form-control" name="title" value="" required>

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
                <textarea id="body" name="body" value="" class="ckeditor" aria-label="With textarea"></textarea>
                @if ($errors->has('body'))
                <span class="help-block">
                    <strong>{{ $errors->first('body') }}</strong>
                </span>
            @endif
            </div>
        </div>
        </div>
       
        <div class="col" id="selectCategory">
            <div class="form-group {{ $errors->has('categories','subcategories') ? ' has-error' : '' }}">
                    <label for="categories" class="control-label m-t-10">Select one category:</label>
                    <select class="custom-select" id="categories" name="categories"required>
                            <option value="">Categories</option>
                        @foreach($categories as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                  
                  @if ($errors->has('categories'))
                  <span class="help-block">
                      <strong>{{ $errors->first('categories') }}</strong>
                  </span>
                  @endif
    

            
                    <label for="subcategories" class="control-label m-t-10">Select one subcategory:</label>
                    <select class="custom-select2" id="subcategories" name="subcategories"required>
                            <option value="0" disabled="true" selected="true">Product Name</option>
                    </select>
                  </div>
                  @if ($errors->has('categories'))
                  <span class="help-block">
                      <strong>{{ $errors->first('categories') }}</strong>
                  </span>
                  @endif
    </div>
          
        

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


