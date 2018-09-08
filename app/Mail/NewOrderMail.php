<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Order;
use App\Post;
use App\User;
use ConsoleTVs\Invoices\Classes\Invoice;

class NewOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $order;
    public $user;
    public $message;
    public $invoice;
    public function __construct($user,$order,$message,$invoice)
    {
        $this->user = $user;
        $this->order = $order;
        $this->message = $message;
        $this->invoice = $invoice;
    }


    public function createInvoice()
    {


        $order = Order::find($this->order->id);
        $post = Post::find($order->post_id);
        $user = User::find($order->buyer_id);



        $invoice = new Invoice;
        $invoice->addItem($post->title, $post->price + 2, 1, $post->id)
            ->number($order->transaction_id)->tax(0)
            ->notes('Thanks for choosing us, if you have any questions please contact us at contact@lfboost.com')
            ->customer([
                'name'      => $user->firstname .' '. $user->lastname ?? $user->name,
                'id'        => $user->id,
                'phone'     => $user->email,
                'location'  => '',

                'country'   => $user->country,
            ])
            ->save('public/invoices/'.$order->transaction_id.'.pdf');
    }

    /**
     * Build the message.
     *
     * @return $this
     */


    public function build()
    {
        $this->createInvoice();
        if($this->invoice == 1)
        {
            return $this->markdown('neworderemail')
                ->subject('Order & Invoice from LFBOOST')
                ->from('no-reply@lfboost.com')
                ->with([
                    'user'=>$this->user,
                    'order'=>$this->order,
                    'message'=>$this->message,
                ])->attach(storage_path('/app/public/invoices/'). $this->order->transaction_id.'.pdf');
        }else{
            return $this->markdown('neworderemail')
                ->subject('You have a recived a new order')
                ->from('no-reply@lfboost.com')
                ->with([
                    'user'=>$this->user,
                    'order'=>$this->order,
                    'message'=>$this->message,
                ]);
        }



    }
}
