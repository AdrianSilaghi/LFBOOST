<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Auth;
use Braintree_Gateway;
use Braintree_Transaction;
use Braintree_Configuration;

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
}
