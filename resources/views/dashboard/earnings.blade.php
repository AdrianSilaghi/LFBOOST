@extends('layouts.dashboard')
@section('content')

<div class="contianer">
    <div class="row">
        <div class="col m-t-20">
           <h1 class="display-4" style="font-size:2.5rem;">
                Earnings
           </h1>
           <hr>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header text-center text-muted">
                    Total Earned
                </div>
                <div class="card-body text-center">
                    <h1 class="display-4" style="font-size:2.5rem;">
                        $0
                    </h1>
                </div>
            </div>
        </div>
        <div class="col">
                <div class="card">
                        <div class="card-header text-center text-muted">
                            Total Whidrawn
                        </div>
                        <div class="card-body text-center">
                            <h1 class="display-4" style="font-size:2.5rem;">
                                $0
                            </h1>
                        </div>
                    </div>
        </div>
        <div class="col">
                <div class="card">
                        <div class="card-header text-center text-muted">
                            Pending Clearence
                        </div>
                        <div class="card-body text-center">
                            <h1 class="display-4" style="font-size:2.5rem;">
                                $0
                            </h1>
                        </div>
                    </div>
        </div>
        <div class="col">
                <div class="card">
                        <div class="card-header text-center text-muted">
                            Available for Whidrawal
                        </div>
                        <div class="card-body text-center">
                            <h1 class="display-4" style="font-size:2.5rem;">
                                $0
                            </h1>
                        </div>
                    </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col m-t-20">
            <p class="text-muted">WITHDRAW: <i class="fab fa-cc-paypal m-l-10 fa-2x"></i></p>
            
        </div>
    </div>
</div>

@endsection