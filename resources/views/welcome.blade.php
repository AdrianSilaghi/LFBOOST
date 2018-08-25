@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
                <div class="jumbotron jumbotron-fluid" id="jumboPage">
                        <div class="container">
                          <h1 class="display-3">Finding a booster, made easy.</h1>
                          <p class="lead m-t-10">The first freelance marketplace for boosting services has arrived!</p>
                          <ul class="list-inline mt-4">
                            <li class="list-inline-item">
                                <a href="/register" role="button" class="bg-green hover:bg-green-dark text-white font-bold py-3 px-4 rounded" id="hireButton">Hire a booster</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="/register" role="button" class="bg-green hover:bg-green-dark text-white font-bold py-3 px-4 rounded" id="boosterButton">Apply as a booster</a>
                            </li>
                          </ul>
                        </div>
                </div>
                <hr>
                <div class="jumbotron jumbotron-fluid" id="liveChatJumbo">
                    <div class="container">
                      <h1 class="display-4"> Live Chat with your Booster</h1>
                      <p class="lead">Your order dashboard includes a real time chat with the booster that is responsible for your order. You can ask him any questions and set up game schedules!</p>
                    </div>
                  </div>
                <hr>
                <div class="jumbotron jumbotron-fluid" id="securityJumbo">
                    <div class="container">
                      <h1 class="display-4">We value Security</h1>
                      <p class="lead">Your order dashboard includes a real time chat with the booster that is responsible for your order. You can ask him any questions and set up game schedules!</p>
                    </div>
                  </div>
                <hr>
                <div class="jumbotron jumbotron-fluid" id="reviewJumbo">
                    <div class="container">
                      <h1 class="display-4">Review system</h1>
                      <p class="lead">Our 5-Star and Review system is essential to LFBOOST.It’s where buyers and sellers can rate their experience after working with each other. </p>
                    </div>
                  </div>
                <hr>
        </div>
    </div>
</div>
@endsection

