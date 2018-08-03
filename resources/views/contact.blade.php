@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col m-t-50">
                <h1 class="text-center" style="font-weight:bold;">Contact Support</h1>
                <hr>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-9 m-t-20" id="issues">
                    <h2 class="form-text text-muted m-b-20" style="font-weight:bold;">
                        Contact Us:
                    </h2>
                    

                            <div class="form-group">
                                    <label for="mainIssue">What can we help you with?</label>
                                    <select class="form-control m-t-10" id="issue" name="issue">
                                    <option value="0" selected disabled>Please choose</option>
                                      <option value="order">Order Issues</option>
                                      <option value="account">Account Issues</option>
                                      <option value="boost">Boost</option>
                                      <option value="payment">Payment</option>
                                    </select>
                            </div>
                        
                
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control m-t-10" id="subject" name="subject" required> 
                        </div>
           
                    
                          <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            
                            <textarea class="form-control m-t-10"  id="message" name="message" rows="3" required></textarea>
                          </div>
                        
                          <hr>
                        <div class="row">
                            <div class="col-8">
                                    <button class="btn btn-success btn-block" id="submitContact" type="button">Submit</button>
                            </div>
                            <div class="col">
                                <small class="form-text text-muted">
                                    We will get back to you in 24-48h.
                                </small>
                            </div>
                        </div>


        </div>
    </div>
</div>
@endsection