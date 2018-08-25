@extends('layouts.dashboard')
@section('content')

<meta name="postID" content="{{$post->id}}">
<div class="flex justify-center">
    <div class="w-3/4 mt-4" id="editBoostDiv">

                    {{ csrf_field() }}
        <h4>Overview</h4>
        <hr>                      
            <label class="h4 text-muted"  for="title" class="col-sm control-label">Title</label>
            <input id="title" minlength="10" type="text" class="form-control form-control-lg" name="title" value="{{$post->title}}" placeholder="" data-parsley-type="alphanum" required>

        
        <div id="selectCategory">                                      
        <hr>
        <label class="h5 text-muted"  for="categories" class="control-label m-t-10 m-l-10">Category:</label>
        <select class="custom-select form-control" id="categories" name="categories"required>
        <option value="{{$post->category_id}}">{{$post->cat_name}}</option>
            @foreach($categories as $cat)
            <option value="{{$cat->id}}">{{$cat->name}}</option>
            @endforeach
        </select>

        <hr>
                <label class="h5 text-muted"  for="subcategories" class="control-label m-t-10 m-l-10">Select one subcategory:</label>
        <select class="custom-select2 form-control" id="subcategories" name="subcategories"required>
        <option value="{{$post->subcat_id}}" selected>{{$post->subcat_name}}</option>
        </select>
    </div>      
        <hr>
        <h4>Pricing</h4>
        <hr>        
        <label class="h4 text-muted"  for="priceDescription">Price Description</label>
        <hr>
        <div id="priceDesc">
        <textarea class="form-control" id="priceDescription" name="priceDescription" rows="3" style="resize:none;" type="text" placeholder="Describe the details of your offering">{{$post->price_description}}</textarea>
        </div>
        <label class="h4 text-muted"  for="price" class="control-label m-t-10 m-l-10">Price:</label>
        <hr>
        <select class="custom-select" id="price" name="price" required>
        <option value="{{$post->price}}"  selected >${{$post->price}}</option>
            @for($i = 5; $i < 1000; $i=$i+5)
                <option value="{{$i}}">${{$i}}</option> 
            @endfor
        </select>
        <hr>
        <label class="h4 text-muted"  for="deliveryTime" class="control-label m-t-10 m-l-10">Delivery time:</label>
                                                 <hr>
        <select class="custom-select" id="delivery_time" name="deliveryTime"required>
                <option value="{{$post->delivery_time}}">{{$post->delivery_time}} Days Delivery</option>
                <option value="1">1 Day Delivery</option>
            @for($i = 2; $i < 30; $i++)
                <option value="{{$i}}">{{$i}} Days Delivery</option> 
            @endfor
        </select>
        <hr>
        <h4>Description & FAQ</h4>
        <hr>
        <label class="h4 text-muted" for="description">Describe your boost</label>
                <hr>
            <textarea class="form-control" id="postDescription" name="postDescription" rows="5" style="resize:none;">{{$post->body}}</textarea>
                <small id="shortDescHelpBlock" class="form-text text-muted">
                        Min 120.
                </small>
                <hr>
                <div id="faqUpdate">
                <label class="h4 text-muted"  for="description">Frequently Asked Questions</label>
                <button type="button" class="btn btn-outline-success btn-sm float-right mt-1" id="faqButton">+</button>
                <hr>
                @for($i=0;$i<count($qa);$i++)
                <div class="accordion" id="accordionExample{{$i}}">
                        <div class="card">
                        <div class="card-header" id="headingOne{{$i}}">
                            <h5 class="mb-0">
                            <button class="btn btn-link text-muted" type="button" data-toggle="collapse" data-target="#collapseOne{{$i}}" aria-expanded="true" aria-controls="collapseOne">
                              <span class="float-left" style="color:#555;">{{$qa[$i]->question}}</span>
                              <i class="fas fa-angle-down ml-4"></i>
                            </button>
                        <a href="{{route('detachQuestions',['postId'=>$post->id,'qa'=>$qa[$i]])}}" class="float-right">
                                    <i class="text-red fas fa-times"></i>
                            </a>
                            </h5>
                          </div>
                      
                        <div id="collapseOne{{$i}}" class="collapse" aria-labelledby="headingOne{{$i}}" data-parent="#accordionExample{{$i}}">
                            <div class="card-body">
                                <div class="col">
                                        {{$qa[$i]->answer}}
                                </div>
                              
                            </div>
                          </div>
                        </div>
                </div>
                @endfor
                <label class="mt-2" for="description">Add Questions & Answers for Your Buyers.</label>
            <div class="form-group" id="faqQ">
                    <div id="faqQA">

                    </div>
                    <div id="faqDone" class="m-t-75 m-b-20">

                    </div>  
            </div>
        </div>
            <hr>
            <div class="form-group">
                    <label class="h5 text-muted" for="">Tell your buyer what you need to get started.</label>
                    <small class="form-text text-muted">Structure your Buyer Instructions as free text.</small>
                    <hr>
                        <textarea name="requirements" class="form-control" id="requirements" style="resize:none;"  rows="5">{{$post->requirements}}</textarea>
                    </div>
            

                <button type="button" id="submitChanges" class="btn btn-success btn-block btn-lg">Save Changes</button>
        

    </div>
</div>

@endsection