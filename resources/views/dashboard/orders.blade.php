@extends('layouts.dashboard')
@section('content')

@php
$user = Auth::user();
@endphp

<div class="container m-b-50">
  <div class="flex-row  flex-row sm:flex-col md:flex-row-reverse lg:flex-col-reverse xl:flex m-t-10">
            <div class="flex-auto text-center m-r-5">
            <a href="/home/create">
                <div class="max-w-sm rounded overflow-hidden shadow-lg text-grey-darker hover:bg-green hover:text-white">
                        <div class="px-6 py-4 group hover:text-white">
                                <div class="font-bold text-xl mb-2 group-hover:text-white">Create a new Boost</div>
                                <i class="fas fa-plus-square fa-7x group-hover:text-white"></i>
                                
                            </div>
                </div>
            </a>
        
        </div>
        <div class="flex-auto text-center m-r-5">
                <a href="{{route('dashboardOrders')}}">
                    <div class="max-w-sm rounded overflow-hidden shadow-lg text-grey-darker hover:bg-green hover:text-white">
                            <div class="px-6 py-4 group hover:text-white">
                                    <div class="font-bold text-xl mb-2 group-hover:text-white">Manage orders</div>
                                    <i class="fas fa-briefcase fa-7x group-hover:text-white"></i>
                                    
                                </div>
                    </div>
                </a>
        </div>
        <div class="flex-auto text-center m-r-5">
                    <a href="{{route('earnings')}}">
                        <div class="max-w-sm rounded overflow-hidden shadow-lg text-grey-darker hover:bg-green hover:text-white">
                                <div class="px-6 py-4 group hover:text-white">
                                        <div class="font-bold text-xl mb-2 group-hover:text-white">Manage earnings</div>
                                        <i class="fas fa-chart-pie fa-7x group-hover:text-white"></i>
                                        
                                    </div>
                        </div>
                    </a>
        </div>
        <div class="flex-auto text-center m-r-5">
                        <a href="{{route('dashboard.getContacts')}}">
                            <div class="max-w-sm rounded overflow-hidden shadow-lg text-grey-darker hover:bg-green hover:text-white">
                                    <div class="px-6 py-4 group hover:text-white">
                                            <div class="font-bold text-xl mb-2 group-hover:text-white">Inbox</div>
                                            <i class="far fa-envelope-open fa-7x group-hover:text-white"></i>
                                            
                                        </div>
                            </div>
                        </a>
        </div>
        <div class="flex-auto text-center">
                <a href="{{route('account')}}">
                    <div class="max-w-sm rounded overflow-hidden shadow-lg text-grey-darker hover:bg-green hover:text-white">
                            <div class="px-6 py-4 group hover:text-white">
                                    <div class="font-bold text-xl mb-2 group-hover:text-white">Settings</div>
                                    <i class="fas fa-cogs fa-7x group-hover:text-white"></i>
                                    
                                </div>
                    </div>
                </a>
</div>              
    </div>

    <div class="flex-row justify-center flex-row sm:flex-col md:flex-row-reverse lg:flex-col-reverse xl:flex m-t-30">
                <div class="flex-auto max-w-xl rounded overflow-hidden shadow-lg text-grey-darker">
                        <div class="flex-auto text-center px-6 py-4">
                                <div class="font-bold jusitfy-center text-xl mb-2 ">
                                <p>    Tasks</p>
                                </div>
                                <i class="fas fa-tasks fa-7x"></i>   
                        </div>
                        <div class="flex-auto text-center px-6 py-4">
                                <ul class="sm:list-reset md:list-reset lg:list-reset xl:list-reset">
                                    @if($user->description==null||
                                    $user->short_description==null||
                                    $user->paypal_email == null||
                                    count($userLangTa) == 0||
                                    count($userGames) == 0||
                                    count($userAchiv) == 0
                                    )
                                    <li class="font-bold">
                                            <p class="text-red-dark">Update your profile!</p>
                                        </li>
                                    @else
                                    <li class="text-3x green font-bold">
                                            <p class="text-green">Great Job! Your profile is complete!</p>
                                        </li>
                                        @endif
                                    @if($user->description == null)
                                        <li class="font-medium text-orange-dark">
                                            Please update your description.
                                        </li>
                                    @endif
                                    @if($user->short_description == null)
                                        <li class="font-medium text-orange-dark">
                                            Please update your one line description.
                                        </li>
                                    @endif
                                    @if($user->paypal_email == null)
                                        <li class="font-medium text-orange-dark">
                                           Please update your PayPal E-mail.
                                        </li>
                                    @endif
                                    @if(count($userLangTa)==0)
                                    <li class="font-medium text-green-dark">
                                       Please add up to four languages in your profile.
                                    </li>
                                    @endif
                                    @if(count($userGames)==0)
                                        <li class="font-medium text-green-dark">
                                        Please add the games you are playing or you offer services in!
                                        </li>
                                    @endif
                                    @if(count($userAchiv)==0)
                                        <li class="font-medium text-green-dark">
                                        Please select notable achivements that you gained over the years playing the specific game!
                                        </li>
                                    @endif
                                </ul>
                        </div>
                </div>
    </div>
            
    </div>
</div>
@endsection