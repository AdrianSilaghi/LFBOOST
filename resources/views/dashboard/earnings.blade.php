@extends('layouts.dashboard')
@section('content')

<div class="contianer" id="payoutPage">
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
                        ${{$user->totalearnings}}
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
                                ${{$user->totalwithdrawal}}
                            </h1>
                        </div>
                    </div>
        </div>
        <div class="col">
                <div class="card">
                        <div class="card-header text-center text-muted">
                            Pending Clearence
                        </div>

                        @php
                        $totalAmmount = 0;
                        foreach($pendingMoney as $pm){
                            $totalAmmount += $pm->ammount;
                        }
                        @endphp
                        <div class="card-body text-center">
                            <h1 class="display-4" style="font-size:2.5rem;">
                                ${{$totalAmmount}}
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
                                ${{$user->availalbeWithdrawal}}
                            </h1>
                        </div>
                    </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col m-t-20">
            <p class="text-muted">WITHDRAW: 
                @if($availalbeWithdrawal > 10)
                <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#payoutModal" > <img src="{{asset('images/ppaccount.png')}}" style="width:60%;height:60%"> </button>
                    @include('dashboard.payoutmodal')
                @else
                <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#payoutModal" disabled > <img src="{{asset('images/ppaccount.png')}}" style="width:60%;height:60%"> </button>
                   <small class="form-text text-muted">Minimum withdraw is $10.</small>
                @endif
               

                <button id="testButton" class="btn btn-outline-dark"> Test </button>
                
{{-- 
                 data-toggle="modal" data-target="#deliverModal" --}}
                {{-- <button id="payout" class="btn btn-outline-primary">test</button> </i></p>
             --}}
        </div>
    </div>
</div>

@endsection