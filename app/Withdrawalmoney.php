<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdrawalmoney extends Model
{
    public $table = 'withdrawalmoney';
    public $primaryKey ='id';

    protected $fillable = [
        'ammount','transaction_id'
    ];

    public function user(){
        return $this->belongsToMany(User::class);
    }
}

