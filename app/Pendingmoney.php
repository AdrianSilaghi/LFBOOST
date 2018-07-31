<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pendingmoney extends Model
{

    public $table = 'pendingmoney';
    public $primaryKey ='id';

    protected $fillable = [
        'ammount','transaction_id','availableAt'
    ];

    public function user(){
        return $this->belongsToMany(User::class);
    }
}
