<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    public $table = 'orders';
    public $primaryKey = 'id';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
}
