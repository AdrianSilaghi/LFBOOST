@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col text-center m-t-50">
                <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                          <h1 class="display-4">Boost your way UP!</h1>
                          <p class="lead">You bring the skill. We'll make earnings easy.</p>
                        </div>
                      </div>
                      <hr>
            <h2 style="font-weight:bold; ">How it works</h2>
            <hr>
            <div class="row m-t-50">
                <div class="col">
                        <i class="far fa-file-alt fa-3x text-muted"></i>
                        <h4 class="text-muted m-t-15">1. Create a Boost!</h4>
                        <p class="text-muted">
                                Sign up for free, set up your Boost, and offer your work to our global audience.
                        </p>
                </div>
                <div class="col">
                        <i class="fas fa-check-double fa-3x text-muted"></i>
                        <h4 class="text-muted m-t-15">2. Deliver Great Services!</h4>
                        <p class="text-muted">
                                Get notified when you get an order and use our system to discuss details with customers.
                        </p>
                </div>
                <div class="col">
                        <i class="fas fa-money-check-alt fa-3x text-muted"></i>
                        <h4 class="text-muted m-t-15">3. Get Paid!</h4>
                        <p class="text-muted">
                                Get paid on time, every time. Payment is transferred to you upon order completion.
                        </p>
                </div>
            </div>
            <hr>

            <div class="row m-t-50 m-b-20">
                <div class="col">
                        <div class="accordion" id="accordionExample1">
                                <div class="card">
                                  <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                            <button class="btn btn-link btn-block float-right text-muted" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                    <span class="float-left" style="color:#555;">What can I sell?</span>    <i class="fas fa-angle-down float-right"></i>
                                            </button>
                                    </h5>
                                  </div>
                              
                                  <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample1">
                                    <div class="card-body">
                                            Be creative! You can offer any service you wish as long as they are up to our quality standars. There are over 30 categories you can browse to get ideas.
                                    </div>
                                  </div>
                                </div>
                                <div class="card">
                                  <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                            <button class="btn btn-link btn-block float-right text-muted" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    <span class="float-left" style="color:#555;">How much money can I make?</span>    <i class="fas fa-angle-down float-right"></i>
                                            </button>
                                    </h5>
                                  </div>
                                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample1">
                                    <div class="card-body">
                                      It's totally up to you! It depends a lot on the quality of the services you offer!
                                    </div>
                                  </div>
                                </div>
                                <div class="card">
                                  <div class="card-header" id="headingThree">
                                    <h5 class="mb-0">
                                            <button class="btn btn-link btn-block float-right text-muted" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    <span class="float-left" style="color:#555;">How much does it cost?</span>    <i class="fas fa-angle-down float-right"></i>
                                            </button>
                                    </h5>
                                  </div>
                                  <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample1">
                                    <div class="card-body">
                                            It's free to join LFBOOST. There is no subscription required or fees to list your services. You keep 80% of each transaction.
                                    </div>
                                  </div>
                                </div>
                              </div>
                </div>
                <div class="col">
                        <div class="accordion" id="accordionExample">
                                <div class="card">
                                  <div class="card-header" id="headingOne1">
                                    <h5 class="mb-0">
                                            <button class="btn btn-link btn-block float-right text-muted" type="button" data-toggle="collapse" data-target="#collapseOne1" aria-expanded="true" aria-controls="collapseOne1">
                                                    <span class="float-left" style="color:#555;">How much time will I need to invest?</span>    <i class="fas fa-angle-down float-right"></i>
                                            </button>
                                    </h5>
                                  </div>
                              
                                  <div id="collapseOne1" class="collapse show" aria-labelledby="headingOne1" data-parent="#accordionExample">
                                    <div class="card-body">
                                            It's very flexible. You need to put in some time and effort in the beginning to learn the marketplace and then you can decide for yourself what amount of work you want to do.
                                    </div>
                                  </div>
                                </div>
                                <div class="card">
                                  <div class="card-header" id="headingTwo2">
                                    <h5 class="mb-0">
                                            <button class="btn btn-link btn-block float-right text-muted" type="button" data-toggle="collapse" data-target="#collapseOne2" aria-expanded="true" aria-controls="collapseOne2">
                                                    <span class="float-left" style="color:#555;">How do I price my service?</span>    <i class="fas fa-angle-down float-right"></i>
                                            </button>
                                    </h5>
                                  </div>
                                  <div id="collapseOne2" class="collapse" aria-labelledby="headingTwo2" data-parent="#accordionExample">
                                    <div class="card-body">
                                           You can set your pricing anywhere from $5 - $995.
                                    </div>
                                  </div>
                                </div>
                                <div class="card">
                                  <div class="card-header" id="headingTwo3">
                                    <h5 class="mb-0">
                                            <button class="btn btn-link btn-block float-right text-muted" type="button" data-toggle="collapse" data-target="#collapseOne3" aria-expanded="true" aria-controls="collapseOne3">
                                                    <span class="float-left" style="color:#555;">How do I get paid?</span>    <i class="fas fa-angle-down float-right"></i>
                                            </button>
                                    </h5>
                                  </div>
                                  <div id="collapseOne3" class="collapse" aria-labelledby="headingTwo3" data-parent="#accordionExample">
                                    <div class="card-body">
                                            Once you complete a buyer's order, the money is transferred to your account. No need to chase clients for payments and wait 60 or 90 days for a check.
                                    </div>
                                  </div>
                                </div>
                              </div>
                </div>
            </div>
            <hr>
            <h4 class="text-muted m-t-20 m-b-20">Sign up and create your first Boost today!</h4>
            <hr>
            <button type="button" class="btn btn-outline-success btn-lg" data-toggle="modal" data-target="#join1">Join</button>

            <div class="modal bd-example-modal-lg" id="join1" role="dialog" aria-labelledby="myLargeModalLabel1" aria-hidden="true">
            <div class="modal-dialog">
                    <div class="modal-content" style="width:400px;">
                        @include('_includes.signupseller')
                    </div>
                
            </div>
            </div 
        </div>
    </div>
</div>
@endsection
