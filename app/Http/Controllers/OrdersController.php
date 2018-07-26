<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;
use App\User;
use App\Order;
use App\Notifications\NotifyOrderOwner;

class OrdersController extends Controller
{
    public function _construct(){

        $this->middleware('auth');
    }

    public function newOrder(Request $request){
        $post = Post::where('id',$request->input('postId'))->first();
        $authUser = Auth::user()->first();
       
        $order = New Order;
        $order->buyer_id = $authUser->id;
        $order->seller_id = $post->user_id;
        $order->transaction_id = $request->input('data.id');
        $order->delivery_time = $post->delivery_time;
        $order->post_id = $post->id;
        $order->save();


        $order = Order::where('seller_id',$post->user_id)->first();
        $user = User::where('id',$order->seller_id)->first();
        $user->notify(new NotifyOrderOwner($order));
        
    }

    public function dashboardOrders(){
        
        $user = auth()->user();
        $orders = Order::where('seller_id',$user->id)->orWhere('buyer_id',$user->id)->get();
        return view('dashboard.orders.orders')->with('orders',$orders);
    }

    public function queuedOrders(){
        $user = auth()->user();
        $order = Order::where('seller_id',$user->id)->orWhere('buyer_id',$user->id)->get();

        $orders= $order->where('queued',true);
        return view('dashboard.orders.orders')->with('orders',$orders);
    }

    public function activeOrders(){
        $user = auth()->user();
        $order = Order::where('seller_id',$user->id)->orWhere('buyer_id',$user->id)->get();

        $orders= $order->where('progress',true);
        return view('dashboard.orders.orders')->with('orders',$orders);
    }

    public function deliveredOrders(){
        $user = auth()->user();
        $order = Order::where('seller_id',$user->id)->orWhere('buyer_id',$user->id)->get();

        $orders= $order->where('pending',true);
        return view('dashboard.orders.orders')->with('orders',$orders);
    }

    public function completedOrders(){
        $user = auth()->user();
        $order = Order::where('seller_id',$user->id)->orWhere('buyer_id',$user->id)->get();

        $orders= $order->where('completed',true);
        return view('dashboard.orders.orders')->with('orders',$orders);
    }


    
}
