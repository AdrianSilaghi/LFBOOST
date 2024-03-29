<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    public $table = 'question';
    public $primaryKey ='id';
    
    public function post(){
        return $this->belongsToMany(Post::class);
    }
}
