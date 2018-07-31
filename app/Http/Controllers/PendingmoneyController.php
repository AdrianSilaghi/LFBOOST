<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pendingmoney;
use App\Order;
use App\Post;
use App\User;
use Carbon\Carbon;
use Auth;

class PendingmoneyController extends Controller
{
    public function _construct()
    {
        $this->middleware('auth');
    }


    public function earnings(){
        $user = Auth::user();        
        $pendingMoney = $user->pendingmoney;

        return view('dashboard.earnings')->with('user',$user)->with('pendingMoney',$pendingMoney);
    }
    

    public function addMoney(Request $request){

        $order = Order::where('transaction_id',$request->transaction_id)->first();
        $seller = User::find($order->seller_id);
        $post = Post::find($order->post_id);
        $deliveredAt = Carbon::parse($order->deliveredAt);
        $availableAt = $deliveredAt->addDays($order->delivery_time);
        
        $price = $post->price;

        $finalPrice = (80/100) * $price;
        
        $pmoney = new Pendingmoney;
        $pmoney->ammount = $finalPrice;
        $pmoney->availableAt = $availableAt;
        $pmoney->transaction_id = $request->transaction_id;
        $pmoney->save();


        $seller->pendingmoney()->attach($pmoney);
        

        return response(200);

    }
}
