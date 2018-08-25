<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Language extends Model
{
    public $table = 'language';
    public $primaryKey ='id';
    
    public function user(){
        return $this->belongsToMany(User::class);
    }
}
