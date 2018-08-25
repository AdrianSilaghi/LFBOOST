<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pendingmoney;
use App\Order;
use App\Post;
use App\User;
use Carbon\Carbon;
use Auth;
use App\Transaction;

class PendingmoneyController extends Controller
{
    public function _construct()
    {
        $this->middleware('auth');
    }


    public function earnings(){
        $user = Auth::user();        
        $pendingMoney = $user->pendingmoney;
        $availalbeWithdrawal = $user->availalbeWithdrawal;
        $totalwithdrawal = $user->totalwithdrawal;
        $transactions = Transaction::where('user_id',$user->id)->get();

        return view('dashboard.earnings')->with('user',$user)
                                        ->with('pendingMoney',$pendingMoney)
                                        ->with('availalbeWithdrawal',$availalbeWithdrawal)
                                        ->with('totalwithdrawal',$totalwithdrawal)
                                        ->with('transactions',$transactions);
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

        $transaction = new Transaction;
        $transaction->user_id = $seller->id;
        $transaction->name = 'Pending Clearence';
        $transaction->ammount = $finalPrice;
        $transaction->transaction_id = $order->transaction_id;
        $transaction->save();

        return response(200);

    }

    public function removeWithdrawal(Request $request){
        $user = Auth::user();
        $totalAmmount = $user->availalbeWithdrawal;
        $payoutAmmount = $request->ammount;
        //new balance = 

        $transaction = new Transaction;
        $transaction->user_id = $user->id;
        $transaction->name = 'Withdrawal';
        $transaction->ammount = $payoutAmmount;
        $transaction->transaction_id = str_random(8);
        $transaction->save();

        $user->availalbeWithdrawal = $totalAmmount - $payoutAmmount;
        $user->totalwithdrawal += $payoutAmmount;
        $user->save();

        return response(200);

    }

    
    
}
