<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;
use App\User;
use App\Order;
use App\Notifications\NotifyOrderOwner;
use Image;

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
        $order->notes = $request->input('noteForBuyer');
        $order->save();


        $order = Order::where('seller_id',$post->user_id)->first();
        $user = User::where('id',$order->seller_id)->first();
        $user->notify(new NotifyOrderOwner($order));
        
    }
    
    public function dashboardOrders(Request $request){
        
        $user = auth()->user();
        $order = Order::where('seller_id',$user->id)->orWhere('buyer_id',$user->id)->get();

        if($request->input('type')!=null){
            $orders= $order->where($request->input('type'),true);
            return view('dashboard.orders.orders')->with('orders',$orders);
        }else{
            return view('dashboard.orders.orders')->with('orders',$order);
        }

       
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

    public function addProof(Request $request){
       
        if($request->hasFile('file')){
            $image = $request->file('file');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save( public_path('/uploads/posts/' . $filename));

        $post = Post::find($request->id);
        $post->image = $filename;
        $post->save();  
        }


    }

    public function speicifOrder(Request $request){
        $order = Order::where('transaction_id',$request->input('orderID'))->first();
        $seller = User::where('id',$order->seller_id)->first();
        $boost = Post::where('id',$order->post_id)->first();
        $buyer = User::where('id',$order->buyer_id)->first();
        $price = $boost->price;
        $priceforSeller = $price * ((100-20)/100);
        return view('dashboard.orders.order')->with('order',$order)->with('seller',$seller)->with('boost',$boost)->with('buyer',$buyer)->with('priceforSeller',$priceforSeller);


    }

    public function markOrderAsComplete(Request $request){
        $order = Order::where('transaction_id',$request->input('transaction_id'))->first();
        $order->pending = false;
        $order->progress = false;
        $order->completed = true;
        $order->queued = false;
        $order->save();
    }

    public function markOrderAsActive(Request $request){
        $order = Order::where('transaction_id',$request->input('transaction_id'))->first();
        $order->pending = false;
        $order->progress = true;
        $order->completed = false;
        $order->queued = false;
        $order->save();
    }

    public function markOrderAsDelivered(Request $request){
        $order = Order::where('transaction_id',$request->input('transaction_id'))->first();
        $order->pending = true;
        $order->progress = false;
        $order->completed = false;
        $order->queued = false;
        $order->save(); 
    }
    
}
