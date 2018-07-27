<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use \Spatie\Tags\HasTags;
use Cache;
use Cviebrock\EloquentSluggable\Sluggable;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;
    use \Spatie\Tags\HasTags;

    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','country',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


    public function messages(){
        return $this->hasMany(Message::class);
    }
    public function order(){
        return $this->hasMany('App\Order');
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function achivement(){
        return $this->belongsToMany(Achivements::class)->withPivot('achivements_id','user_id','game_name');
    }

    public function lang(){
        return $this->belongsToMany(Language::class)->withPivot('user_id','language_id','level');
    }

    public function game(){
        return $this->belongsToMany(Game::class)->withPivot('user_id','game_id');
    }
    

    public function isOnline(){

        return Cache::has('user-is-online-'. $this->id);
    }
}

