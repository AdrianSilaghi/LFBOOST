@extends('layouts.dashboard')
@section('content')

<div class="contianer">
    <div class="row">
        <div class="col">
            <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link active" href="#">All</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">New</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Active</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Delivered</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Completed</a>
                  </li>
              </ul>
        </div>
    </div>
</div>

@endsection