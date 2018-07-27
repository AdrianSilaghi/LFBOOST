@extends('layouts.create')
@section('content')

<div class="container">
<div class="row justify-content-md-center m-t-20">
    <div class="col-md-10 col-offset-2">
        {{ csrf_field() }}
            <div id="smartwizard">
                    <ul>
                        <li><a href="#step-1">Overview<br /><small></small></a></li>
                        <li><a href="#step-2">Pricing<br /><small></small></a></li>
                        <li><a href="#step-3">Description & FAQ<br /><small></small></a></li>
                        <li><a href="#step-4">Requirements<br /><small></small></a></li>
                    </ul>
                
                    <div>
                        <div id="step-1" class="">
                            <hr>
                            <div class="col">
                                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}" id="titleInput">
                                    
                                        <label class="h4 text-muted"  for="title" class="col-sm control-label">Title</label>
                                    
                                    <div class="row">

                                        <div class="col-md-8">

                                            <input id="title" minlength="10" type="text" class="form-control form-control-lg" name="title" value="" placeholder="" data-parsley-type="alphanum" required>
                                            <small id="shortDescHelpBlock" class="form-text text-muted">
                                                    Minimum 15 characters.
                                            </small>
                                            
                                        </div>
                                        
                                        <div class="col">

                                                <small id="shortDescHelpBlock" class="form-text text-muted">
                                                        Title is the first thing buyers see about your boost!
                                                        <hr>
                                                        Make sure it is representative of what the service will offer!
                                                </small>

                                        </div>
                                            @if ($errors->has('title'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                </div>
                            </div>
                            <hr>
                                    <div class="col" id="selectCategory">
                                        <div class="row">
                                            <div class="form-group {{ $errors->has('categories','subcategories') ? ' has-error' : '' }}">
                                                    
                                                    <div class="col">
                                                    <label class="h5 text-muted"  for="categories" class="control-label m-t-10 m-l-10">Category:</label>
                                                    <select class="custom-select form-control-lg" id="categories" name="categories"required>
                                                            <option value="">SELECT A CATEGORY</option>
                                                        @foreach($categories as $cat)
                                                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <small id="shortDescHelpBlock" class="form-text text-muted">
                                                            The boost will end up in this category! Choose carefully.
                                                    </small>
                                                </div>
                                                  @if ($errors->has('categories'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('categories') }}</strong>
                                                  </span>
                                                  @endif
                                            </div>
                                            <div class="form-group {{ $errors->has('categories','subcategories') ? ' has-error' : '' }}">
                                            
                                                   
                                                    <div class="col">
                                                            <label class="h5 text-muted"  for="subcategories" class="control-label m-t-10 m-l-10">Select one subcategory:</label>
                                                    <select class="custom-select2 form-control-lg" id="subcategories" name="subcategories"required>
                                                            <option value="0" disabled="true" selected="true">SELECT A SUBCATEGORY</option>
                                                    </select>
                                                    <small id="shortDescHelpBlock" class="form-text text-muted">
                                                            Choose an appropiate subcategory.
                                                    </small>
                                                </div>
                                                  </div>
                                                  @if ($errors->has('categories'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('categories') }}</strong>
                                                  </span>
                                                  @endif
                                                  </div>
                                    </div>
                                    <hr>
                                    <div class="col m-b-20">
                                        <div class="row">
                                            
                                            <div class="col">
                                                    <label class="h4 text-muted"  for="tags" class="control-lable m-t-10 m-r-10">Search Tags:</label>
                                                    <small id="shortDescHelpBlock" class="form-text text-muted float-right">
                                                            Up to 5 terms.
                                                    </small>
                                                    <div class="form-group">
                                                            <input data-role="tagsinput" id="tags" value=""  class="form-control"  type="text">
                                                            <small id="shortDescHelpBlock" class="form-text text-muted">
                                                                    1 term minimum.
                                                            </small>
                                                           
                                                    </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <hr>

                        </div>
                        <div id="step-2" class="">
                            
                                <div class="col">
                                    <hr>
                                    <div class="d-flex align-items-end">
                                        
                                        <div class="col-md-9"> 
                                            <label class="h4 text-muted"  for="priceDescription">Description</label>
                                            <hr>
                                            <textarea class="form-control" id="price_description" name="priceDescription" rows="3" style="resize:none;" type="text" placeholder="Describe the details of your offering"></textarea>
                                        </div>
                                        <div class="col">
                                                <small id="shortDescHelpBlock" class="form-text text-muted">
                                                        Summarize what this boost offers buyers, and why you included these items in your boost.
                                                        <br>
                                                        (e.g:"5 games won in ranked <br>"You will reach x ELO" <br> "You will reach x ILVL" <br> etc )
                                                </small>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="d-flex align-items-end">
                                           <div class="col-md-9">
                                                <label class="h4 text-muted"  for="price" class="control-label m-t-10 m-l-10">Price:</label>
                                                <hr>
                                                <select class="custom-select" id="price" name="price" required>
                                                        <option value="" disabled selected hidden>$5-$995</option>
                                                    @for($i = 5; $i < 1000; $i=$i+5)
                                                        <option value="{{$i}}">${{$i}}</option> 
                                                    @endfor
                                                </select>
                                                
                                           </div>
                                           <div class="col">
                                                <small id="shortDescHelpBlock" class="form-text text-muted">
                                                        Choose a price between $5 and $995.
                                                </small>
                                           </div>
                                    </div>
                                    <hr>    
                                    <div class="d-flex align-items-end">
                                            <div class="col-md-9">
                                                 <label class="h4 text-muted"  for="deliveryTime" class="control-label m-t-10 m-l-10">Delivery time:</label>
                                                 <hr>
                                                 <select class="custom-select" id="delivery_time" name="deliveryTime"required>
                                                         <option value="" disabled selected hidden>Delivery Time</option>
                                                         <option value="1">1 Day Delivery</option>
                                                     @for($i = 2; $i < 30; $i++)
                                                         <option value="{{$i}}">{{$i}} Days Delivery</option> 
                                                     @endfor
                                                 </select>
                                                 
                                            </div>
                                            <div class="col">
                                                 <small id="shortDescHelpBlock" class="form-text text-muted">
                                                        Delivery time is your deadline for delivering an order. Be sure to set a delivery time that you can easily meet! Late deliveries can result in cancellations or affect your reputation.
                                                 </small>
                                            </div>
                                     </div>
                                </div>
                            
                        </div>
                        <div id="step-3" class="">
                            <hr>
                            <div class="col">
                                <div class="d-flex align-items-center">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                                <label class="h4 text-muted" for="description">Describe your boost</label>
                                                <hr>
                                                <textarea class="form-control" id="body" name="postDescription" rows="5" style="resize:none;"></textarea>
                                                <small id="shortDescHelpBlock" class="form-text text-muted">
                                                        Min 120.
                                                </small>
                                        </div>
                                    </div>
                                    <div class="col">
                                            <small id="shortDescHelpBlock" class="form-text text-muted">
                                            Describe what you are offering. 
                                            Be as detailed as possible so buyers will be able to understand if this meets their needs. 
                                            Should be at least 120 characters.
                                            </small>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex align-items-start">
                                    <div class="col-md-9" id="faq">
                                            <label class="h4 text-muted"  for="description">Frequently Asked Questions</label>
                                            <button type="button" class="btn btn-outline-success btn-sm float-right" id="faqButton">+</button>
                                            <hr>
                                            <label for="description">Add Questions & Answers for Your Buyers.</label>
                                        <div class="form-group" id="faqQ">
                                                <div id="faqQA">

                                                </div>
                                                <div id="faqDone" class="m-t-75 m-b-20">

                                                </div>  
                                        </div>
                                        
                                    </div>
                                    <div class="col">
                                        <small class="form-text text-muted">
                                                Here you can add answers to the most commonly asked questions. Your FAQs will be displayed in your Boost page.
                                        </small>
                                            
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <div id="step-4" class="">
                            <hr>
                            <div class="col">
                                
                                    <div class="d-flex align-items-center">
                                        <div class="col-md-9">
                                        
                                                <div class="form-group">
                                                <label class="h5 text-muted" for="">Tell your buyer what you need to get started.</label>
                                                <small class="form-text text-muted">Structure your Buyer Instructions as free text.</small>
                                                <hr>
                                                <textarea name="requirements" class="form-control" id="requirements" style="resize:none;"  rows="5"></textarea>
                                                </div>
                                        </div>
                                        <div class="col">
                                            <small class="form-text text-muted">Indicate what you need before you can start working. <br> 
                                            (e.g Provide me with the following information: Game ID, etc)
                                            </small>
                                        </div>
                                </div>
                                <div class="d-flex">
                                    <div class="col" id="uploadForm">
                                    <form action="{{url('/order/api/addProof')}}" class="dropzone">
                                    {{ csrf_field() }}
                                    </form>
                                       
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
</div>
</div>

@endsection