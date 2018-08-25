<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\User;
use Auth;

class PayoutAmmount implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = Auth::user();
        $withdrawalMoney = $user->withdrawalmoney;

        $totalAmmountw = 0;
        foreach($withdrawalMoney as $wd){
            $totalAmmountw += $wd->ammount;
        }
        
        $maxAmmount = $user->availalbeWithdrawal;

        if(!empty($value)){
            if($value <= 10){
                return false;
            }else{

                if($value <= $maxAmmount){
                    return true;
                }else{
                    return false;
                }
        }
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This ammount is higher than you have in the bank!';
    }
}
