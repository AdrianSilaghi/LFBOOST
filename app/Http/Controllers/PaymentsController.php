<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Auth;
use Braintree_Gateway;
use Braintree_Transaction;
use Braintree_Configuration;
use App\Rules\PayoutAmmount;

class PaymentsController extends Controller
{
    
    
    public function _construct(){
     
    }

    public function token(){

        $gateway = new Braintree_Gateway([
            'environment' => 'sandbox',
            'merchantId' => '3hgxcsq8jcm8z29w',
            'publicKey' => '82kpz468m9nhxn7n',
            'privateKey' => '58555425302a97c454014bb20d295b57'
          ]);
          
          $aCustomerId = $gateway->customer()->create([
            'firstName' => auth()->user()->firstname,
            'lastName' => auth()->user()->lastname,
            'email' => auth()->user()->email,

        ]);
        $aCustomerId->customer->id;

        $clientToken = $gateway->clientToken()->generate([
    
        ]);

        return response()->json($clientToken);
    }

    public function getPostPrice(Request $request){
        $post = Post::where('id',$request->input('postId'))->first();
        $price = $post->price;
        
        
        return response()->json($price);
    }
    public function payment(Request $request){

       
        $gateway = new Braintree_Gateway([
            'environment' => 'sandbox',
            'merchantId' => '3hgxcsq8jcm8z29w',
            'publicKey' => '82kpz468m9nhxn7n',
            'privateKey' => '58555425302a97c454014bb20d295b57'
          ]);

          $payload = $request->input('payload',false);
          $nonce = $payload['nonce'];
            
          $post = Post::where('id',$request->input('postId'))->first();

          $status = Braintree_Transaction::sale([
          'amount' => $post->price+2,
          'paymentMethodNonce' => $nonce,
          'options' => [
              'submitForSettlement' => True
          ]
          ]);
          session()->flash('success','Your payment was successful , order and a new conversation were created!');
          return response()->json($status);
    }

    public function overview(Request $request){

        $posts = Post::where('id',$request->id)->first();

        $reviews = $posts->review;
        
        if(count($reviews)==0){
            $avg = 0;
            $countReviews = 0;
        }else{

        
        foreach($reviews as $r){
            

                $a[] = $r->raiting;

            
            }

            $avg = round(array_sum($a)/count($a),1);
            $countReviews = count($a);
        }
        return view('payments.overview')->with('post',$posts)->with('raiting',$avg)->with('countReviews',$countReviews);
    }

    
    public function finish(Request $request){

        $posts = Post::where('id',$request->id)->first();

        $reviews = $posts->review;
        
        if(count($reviews)==0){
            $avg = 0;
            $countReviews = 0;
        }else{

        
        foreach($reviews as $r){
            

                $a[] = $r->raiting;

            
            }

            $avg = round(array_sum($a)/count($a),1);
            $countReviews = count($a);
        }
        return view('payments.finish')->with('post',$posts)->with('raiting',$avg)->with('countReviews',$countReviews);
    }

    public function validatePayout(Request $request){
        

        $this->validate($request,[
            'ammount'=> ['required',new PayoutAmmount],
            'email'=>'required|email'
        ]);

        return response(200);
    }


    public function payout(Request $request){

        $this->validate($request,[
            'ammount'=> ['required',new PayoutAmmount],
            'email'=>'required|email'
        ]);
        
        $email = $request->email;
        $ammount = $request->ammount;
        
        
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
              'AY44Io5lRKKKUS64t6TZapX2AMAc8ul_Mo9WPs8VFjd5ABWX_cb7mo0RppjZEvQvYdqFkBhssXKjJ4kc',
              'ENmpQcK5gqBGdECmDjGjlz4xNV1LpwLYSqSpTktoVsEY2vZGefmwO6v-O6bl_d7X5WdxPdWmWCKg0E0x'
            )
          );

        $payouts = new \PayPal\Api\Payout();
    

        $senderBatchHeader = new \PayPal\Api\PayoutSenderBatchHeader();

        $senderBatchHeader->setSenderBatchId(uniqid())
            ->setEmailSubject("You have a payment");
        
            $senderItem1 = new \PayPal\Api\PayoutItem(
                array(
                    "recipient_type" => "EMAIL",
                    "receiver" => $email,
                    "note" => "Thank you.",
                    "sender_item_id" => uniqid(),
                    "amount" => array(
                        "value" => $ammount,
                        "currency" => "USD"
                    )
            
                )
            );

        $payouts->setSenderBatchHeader($senderBatchHeader)
                ->addItem($senderItem1);
        

        $request = clone $payouts;
        
        try {
            $output = $payouts->create(null,$apiContext);
        } catch (Exception $ex) {
            return $ex;
            exit(1);
        }
        
        return $output;
    }


}
