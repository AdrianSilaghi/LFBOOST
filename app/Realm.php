<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Spatie\Tags\HasTags;
class Realm extends Model
{
    
    use \Spatie\Tags\HasTags;
    public $table = 'realms';
    public $primaryKey ='id';

    public function post(){
        return $this->belongsToMany('App\Post');
    }

}
