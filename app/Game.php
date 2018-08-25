<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Game extends Model
{
    public $table = 'games';
    public $primaryKey ='id';
    
    public function user(){
        return $this->belongsToMany(User::class);
    }
    
    public function achiv(){
        return $this->hasMany('App/Achivmenets');
    }
}
