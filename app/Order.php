<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $table = 'orders';
    public $primaryKey = 'id';

    public function user(){
        return $this->belongsTo('App\User');
    }
}
