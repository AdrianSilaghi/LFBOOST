@extends('layouts.home')
@section('content')
<div class="col-sm m-t-100 m-l-50">
<table class="table is-bordered">
    <thead>
        <tr>
            <th>
                #
            </th>
            <th>
                Name
            </th>
            <th>
                Delete
            </th>
        </tr>
    </thead>
    <tbody>
        
            @foreach($realm as $realm)
        <tr>
            <th>{{$realm->id}}</th>
            <th>{{$realm->name}}</th>
            <th>
                    {!!Form::open(['action' => ['RealmsController@destroy',$realm->id],'method' => 'POST'])!!}
                    {{Form::hidden('_method','DELETE')}}
                    {{Form::submit('Delete',['class'=> 'btn btn-danger'])}}
                    {!!Form::close()!!}
            </th>
        </tr>
            @endforeach
    </tbody>
</table>
</div>
<div class="col-sm m-l-100 m-t-100">
        <div class="card">
            <div class="card-body"></div>
    <form class="form-horizontal" method="POST" action="{{ route('realms.store') }}">
            {{ csrf_field() }}
    
            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <label for="title" class="col-sm control-label">Name of realm</label>
    
                <div class="col">
                    <input id="name" type="text" class="form-control" name="name" value="" required autofocus>
    
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                    <div class="col-sm-4 m-t-20">
                        <button type="submit" class="btn btn-primary">
                            Create
                        </button>
                    </div>
                </div> 
    </form>
        </div>
</div>

@endsection