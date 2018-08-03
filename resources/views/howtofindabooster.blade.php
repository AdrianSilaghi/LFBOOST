@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col text-center">
                <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                          <h1 class="display-4">How to find the right booster?</h1>
                          <p class="lead">Use LFBOOST to easily hire boosters for yourself!</p>
                          <small class="form-text text-muted">Browse trough tousands of boosts and categories.</small>
                        </div>
                </div>  
                <hr> 
        </div>
    </div>
    <div class="row">
        <div class="col text-center">
            <h5>4 Easy steps to find a Booster:</h5>
            <hr>
            <small class="form-text text-muted">
                Use LFBOOST search to find the right booster for yourself! Once you've found a service you'd like to order , click the boost. <br> Choosing the right one is easy:
            </small>
            <hr>
            <ul class="list-unstyled m-t-20">
                    <li>1. Check out the booster's available <span style="font-weight:bold">boosting services</span>.</li>
                    <li>2. Check out the <span style="font-weight:bold">feedback</span> from other buyers like you.</li>
                    <li>3. Choose the <span style="font-weight:bold">service</span> that fits your needs the most.</li>
                    <li>4. <span style="font-weight:bold;">Contact</span> the booster for any questions to make sure they meet your needs.</li>
            </ul>
            <hr>
            <a  role="button" href="/home" class="btn btn-outline-success btn-lg">Browse Boosts</a>
        </div>
    </div>
</div>
@endsection
