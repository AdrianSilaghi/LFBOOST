<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TitleValidation implements Rule
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
        if(preg_match("/^((\b[a-zA-Z0-9-+]{2,40}\b)\s*){3,}$/", $value)){
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
        return 'Title must contain at least 3 words.';
    }
}
