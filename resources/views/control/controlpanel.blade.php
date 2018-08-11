@extends('layouts.app')

@section('content')
<div class="container m-b-50">
    <div class="flex-row  flex-row sm:flex-col md:flex-row-reverse lg:flex-col-reverse xl:flex m-t-10">
              <div class="flex-auto text-center m-r-5">
              <a href="{{route('manageUsers')}}">
                  <div class="max-w-sm rounded overflow-hidden shadow-lg text-grey-darker hover:bg-green hover:text-white">
                          <div class="px-6 py-4 group hover:text-white">
                                  <div class="font-bold text-xl mb-2 group-hover:text-white">Manage Users</div>
                                  <i class="fas fa-plus-square fa-7x group-hover:text-white"></i>
                                  
                              </div>
                  </div>
              </a>
          
          </div>
          <div class="flex-auto text-center m-r-5">
                  <a href="{{route('manageOrders')}}">
                      <div class="max-w-sm rounded overflow-hidden shadow-lg text-grey-darker hover:bg-green hover:text-white">
                              <div class="px-6 py-4 group hover:text-white">
                                      <div class="font-bold text-xl mb-2 group-hover:text-white">Manage Orders</div>
                                      <i class="fas fa-briefcase fa-7x group-hover:text-white"></i>
                                      
                                  </div>
                      </div>
                  </a>
          </div>
          <div class="flex-auto text-center m-r-5">
                      <a href="{{route('managePosts')}}">
                          <div class="max-w-sm rounded overflow-hidden shadow-lg text-grey-darker hover:bg-green hover:text-white">
                                  <div class="px-6 py-4 group hover:text-white">
                                          <div class="font-bold text-xl mb-2 group-hover:text-white">Manage Posts</div>
                                          <i class="fas fa-chart-pie fa-7x group-hover:text-white"></i>
                                          
                                      </div>
                          </div>
                      </a>
          </div>
             
      </div>
</div>

@endsection