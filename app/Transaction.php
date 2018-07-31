<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public $table = 'transactions';
    public $primaryKey ='id';

    protected $fillable = [
       'user_id','name','status','transaction_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
