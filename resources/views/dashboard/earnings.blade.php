@extends('layouts.dashboard')
@section('content')

@inject('carbon','Carbon\Carbon')
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
        <div class="col">
            <hr>
            <p class="text-muted">WITHDRAW: 
                @if($availalbeWithdrawal > 10)
                <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#payoutModal" > <img src="{{asset('images/ppaccount.png')}}" style="width:60%;height:60%"> </button>
                    @include('dashboard.payoutmodal')
                @else
                <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#payoutModal" disabled > <img src="{{asset('images/ppaccount.png')}}" style="width:60%;height:60%"> </button>
                   <small class="form-text text-muted">Minimum withdrawal is $10.</small>
                @endif
               <hr>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table" id="transactionTable">
                <thead>
                  <tr>
                    <th scope="col">Date</th>
                    <th scope="col">For</th>
                    <th scope="col">Ammount</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($transactions as $tr)  
                  @php
                    $date = $carbon->parse($tr->created_at);
                  @endphp
                  <tr>
                  <td>{{$date->toFormattedDateString()}}</td>
                  <td>{{$tr->name}}</td>
                  <td>${{$tr->ammount}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>

@endsection