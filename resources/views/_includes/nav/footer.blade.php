@inject('categories','App\Category')
@php
$categories = $categories->all();
@endphp
<div class="container">
    <div class="row">
        <div class="col">
            <hr>
                <img src="{{asset('images/logos/logoGood.png')}}" alt="Logo of LFBOOST">
                <small class="form-text text-muted">@LFBOOST 2018 All rights reseverd.</small>
                <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
                <p class="text-muted" style="font-weight:bold;">Categories</p>
                <ul class="list-unstyled">
                    @foreach($categories as $cat)
                        <a href="{{route('showSpecificCat',$cat->name)}}" class="text-muted"><li class="m-b-10">{{$cat->name}}</li></a>
                    @endforeach
                </ul>
        </div>
        <div class="col-3">
                <p class="text-muted" style="font-weight:bold;">About</p>
                <ul class="list-unstyled">
                <a href="{{route('privacy')}}" class="text-muted"><li class="m-b-10">Privacy Policy</li></a>
                        <a href="{{route('tos')}}" class="text-muted"><li class="m-b-10">Terms of Service</li></a>
                </ul>
        </div>
        <div class="col-3">
                <p class="text-muted" style="font-weight:bold;">Support</p>
                <ul class="list-unstyled">
                        <a href="/contact" class="text-muted"><li class="m-b-10">Contact Support</li></a>
                        <a href="{{route('trustsafety')}}" class="text-muted"><li class="m-b-10">Trust & Safety</li></a>
                        <a href="{{route('howToFind')}}" class="text-muted"><li class="m-b-10">Buying on LFBoost</li></a>
                        <a href="{{route('becomeSeller')}}" class="text-muted"><li class="m-b-10">Selling on LFBoost</li></a>
                </ul>
        </div>
        <div class="col-3">
                <p class="text-muted" style="font-weight:bold;">For Boosters</p>
                <ul class="list-unstyled">
                        <a href="{{route('becomeSeller')}}" class="text-muted"><li class="m-b-10">Become a seller</li></a>
                </ul>
        </div>
    </div>
</div>

<p class="text-center text-sm">Made and mantained with  <i  class="fas fa-heart text-red-dark"></i> by S.A.F.I.</p>