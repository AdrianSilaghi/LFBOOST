<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    public $table = 'contacts';
    public $primaryKey = 'id';

    public $fillable = [
        'user_id', 'contact_id'
    ];
    
}
