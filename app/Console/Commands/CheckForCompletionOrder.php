<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Post;
use App\Order;
use App\User;
use Carbon\Carbon;
use App\Review;
use App\Transaction;
use App\Pendingmoney;

class CheckForCompletionOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:ordercompletion';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks if the buyer has replied to the order within 3 days time otherwise mark it complete.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $orders = Order::where('pending','1')->get();

        foreach($orders as $order)
        {
            $deliveredAt = new Carbon($order->deliveredAt);
            $shouldBeCompleted = new Carbon($deliveredAt);
            $shouldBeCompleted->addDays(3);

            if($shouldBeCompleted->isToday())
            {
                $order->pending = false;
                $order->progress = false;
                $order->completed = true;
                $order->queued = false;
                $order->save();

                $review = new Review;
                $review->comment = 'Very good job, great boost!';
                $review->raiting = '5';
                $review->user_id = $order->buyer_id;
                $review->save();

                $post = Post::where('id',$order->post_id)->first();

                $post->review()->attach($review);


                $seller = User::find($order->seller_id);
                $post = Post::find($order->post_id);
                $deliveredAt = Carbon::parse($order->deliveredAt);
                $availableAt = $deliveredAt->addDays($order->delivery_time);

                $price = $post->price;

                $finalPrice = (80/100) * $price;

                $pmoney = new Pendingmoney;
                $pmoney->ammount = $finalPrice;
                $pmoney->availableAt = $availableAt;
                $pmoney->transaction_id = $order->transaction_id;
                $pmoney->save();


                $seller->pendingmoney()->attach($pmoney);

                $transaction = new Transaction;
                $transaction->user_id = $seller->id;
                $transaction->name = 'Pending Clearence';
                $transaction->ammount = $finalPrice;
                $transaction->transaction_id = $order->transaction_id;
                $transaction->save();

             }else{
                $this->info('No jobs to be completed today.');
            }
            $this->info('Jobs Done');
        }
    }
}
