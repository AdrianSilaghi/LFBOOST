
<!-- Modal -->
@inject('auth','Auth')
@inject('user','App\User')
@php
$user = auth::user();
$paypal_email = $user->paypal_email;
@endphp
<div class="modal fade" id="payoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">WITHDRAW</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <div class="input-group input-group-lg">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-lg">Ammount:</span>
                    </div>
                <input type="text" class="form-control" id="ammount" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg"  required>
                
                </div>
                <small class="fomr-text text-muted">
                    <hr>
                        Maximum ammount: ${{$user->availalbeWithdrawal}}
                        <hr>
                    </small>
            <div class="input-group input-group-lg">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-lg">PayPal Email:</span>
                    </div>
                  <input type="email" id="emailInput" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" value="{{$paypal_email}}" readonly required>
                    <small class="fomr-text text-muted">
                        <hr>
                       This is the email which you updated in Settings->Payment.
                        <hr>
                    </small>
                </div>
                <button id="payout" class="btn btn-primary btn-lg m-t-10">WITHDRAW</button>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
    </div>
</div>