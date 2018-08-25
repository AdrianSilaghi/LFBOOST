<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pendingmoney extends Model
{

    use SoftDeletes;

    public $table = 'pendingmoney';
    public $primaryKey ='id';

    protected $fillable = [
        'ammount','transaction_id','availableAt'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function user(){
        return $this->belongsToMany(User::class);
    }
}
