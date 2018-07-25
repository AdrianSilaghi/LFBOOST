<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public $table = 'reviews';
    public $fillable = ['comment','raiting'];
    public $primaryKey = 'id';

    public function post(){
        return $this->belongsToMany(Post::class);
    }
}
