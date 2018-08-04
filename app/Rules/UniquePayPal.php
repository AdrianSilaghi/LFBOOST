<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\User;
use Auth;

class UniquePayPal implements Rule
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
        $paypalEmails = User::where('paypal_email',$value)->get();
        if(count($paypalEmails) == 0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'No two users can have the same withdrawal email.';
    }
}
