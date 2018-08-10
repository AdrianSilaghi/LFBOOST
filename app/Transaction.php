<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use SoftDeletes;
    public $table = 'transactions';
    public $primaryKey ='id';

    protected $fillable = [
       'user_id','name','status','transaction_id'
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
