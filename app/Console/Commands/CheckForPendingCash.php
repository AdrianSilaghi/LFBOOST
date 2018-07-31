<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Post;
use App\Order;
use App\User;
use App\Pendingmoney;
use App\Withdrawalmoney;
use Carbon\Carbon;

class CheckForPendingCash extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:pendingcash';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will check for pendingcash and then move it to withdrawl';

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
        $pendingMoney = Pendingmoney::all();

        foreach($pendingMoney as $pm){
            $order = Order::where('transaction_id',$pm->transaction_id)->first();
            $seller = User::find($order->seller_id);
            $availableAt = new Carbon($pm->availableAt);
            if($availableAt->isToday()){
                $allWithdrawals = Withdrawalmoney::where('transaction_id',$pm->transaction_id)->first();
                $this->info($allWithdrawals);
                if($allWithdrawals != null){
                    $this->info('there is already a transaction for this transaction_id');
                }else{
                    $withdrawal = new Withdrawalmoney;
                    $withdrawal->ammount = $pm->ammount;
                    $withdrawal->transaction_id = $pm->transaction_id;
                    $withdrawal->save();

                    $seller->withdrawalmoney()->attach($withdrawal);
                    $seller->pendingmoney()->detach($pm);

                    $sellerEarnings = $seller->totalearnings;
                    $sellerEarnings += $withdrawal->ammount; 
                    $seller->totalearnings = $sellerEarnings;
                    $seller->save();
                    $this->info('Job Done');
                }
            }else{
                $this->info('No orders available today!');
            }
        }
    }
}
