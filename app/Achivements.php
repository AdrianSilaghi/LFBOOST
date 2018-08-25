<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Spatie\Tags\HasTags;
use App\User;

class Achivements extends Model
{
    
    use \Spatie\Tags\HasTags;
    public $table = 'achivements';
    public $primaryKey ='id';

    
    public function user(){
        return $this->belongsToMany(User::Class);
    }
    public function game(){

        return $this->belongsTo('App/Game');
    }
}
