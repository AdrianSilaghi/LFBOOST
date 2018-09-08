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
use Srmklive\PayPal\Services\ExpressCheckout;
use Illuminate\Http\Response;
use App\Notifications\NotifyOrderOwner;
use App\Order;
use App\Contacts;
use App\Http\Controllers\ContactsController;
use App\Mail\NewOrderMail;
use Illuminate\Support\Facades\Mail;


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

    public function payWithPaypal(Request $request)
    {

        $post = Post::find($request->postID);
        $provider = new ExpressCheckout;

        $noteForSeller = $request->notesForSeller;
        $invoiceId = uniqid();
        $data=$this->getData($post,$invoiceId,$noteForSeller);


        $response = $provider->setExpressCheckout($data);


        return redirect($response['paypal_link']);
    }

    protected function getData($post,$invoiceId,$noteForSeller){

        $data = [];
        $data['items'] = [
            [
                'name' => $post->title,
                'price' => $post->price+2,
                'qty' => 1
            ],
        ];

        $data['invoice_id'] = $invoiceId;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('storePayment',['postId'=>$post->id,'noteForSeller'=>$noteForSeller]);
        $data['cancel_url'] = url('/home');

        $total = $post->price+2;

        $data['total'] = $total;

        return $data;
    }

    public function storePayment(Request $request){


        $provider = new ExpressCheckout;

        $token = $request->token;
        $PayerID = $request->PayerID;
        $post = Post::find($request->postId);
        $noteForSeller = $request->noteForSeller;

        $invoiceId=$request['INVNUM']??uniqid();

        $data = $this->getData($post,$invoiceId,$noteForSeller);

        $response = $provider->getExpressCheckoutDetails($token);

        $response = $provider->doExpressCheckoutPayment($data, $token, $PayerID);


        $authUser = Auth::user();

        //creating a new order
        $order = New Order;
        $order->buyer_id = $authUser->id;
        $order->seller_id = $post->user_id;
        $order->transaction_id = $data['invoice_id'];
        $order->delivery_time = $post->delivery_time;
        $order->post_id = $post->id;
        $order->notes = $noteForSeller;
        $order->save();

        $trans_id = $data['invoice_id'];
        $order = Order::where('transaction_id',$trans_id)->first();
        $seller = User::find($order->seller_id);
        $seller->notify(new NotifyOrderOwner($order));

        $buyer = User::find($order->buyer_id);

        Mail::to($seller->email)->send(new NewOrderMail($seller,$order,'You have recived a new order , please check click on the button below to accept it.','0'));
        Mail::to($buyer->email)->send(new NewOrderMail($buyer,$order,'Thanks for choosing us, below you can access the order page to see the progress also we attached the invoice in the email check it if you would like.','1'));


        $contacts = new ContactsController;

        if($contacts->checkIfContacts($post->user_id,$authUser->id) == 2)
        {
            $contacts->store($post->user_id,$authUser->id);
        }




        return redirect('dashboard')->with('status', 'Your payment was successful, order and a new conversation have been created!');
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
