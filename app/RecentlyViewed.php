<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecentlyViewed extends Model
{
    public $table = 'recently_vieweds';

    protected $fillable = [
        'user_id',
        'post_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
