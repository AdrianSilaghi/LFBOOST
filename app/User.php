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
    use SoftDeletes;
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


    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
    
    public function pendingmoney(){
        return $this->belongsToMany(Pendingmoney::class)->withPivot('pendingmoney_id','user_id');
    }

    public function withdrawalmoney(){
        return $this->belongsToMany(withdrawalmoney::class)->withPivot('withdrawalmoney_id','user_id');
    }

    public function contactsOfMine(){
        return $this->belongsToMany('App\User','contacts','user_id','contact_id');
    }

    
    public function contactsOf(){
        return $this->belongsToMany('App\User','contacts','contact_id','user_id');
    }
    
    public function contacts(){
        return $this->contactsOfMine->merge($this->contactsOf);
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

        public function verifyuser(){
        return $this->hasOne('App\VerifyUser');
    }

    public function recentlyviewed(){
        return $this->hasMany(RecentlyViewed::class);
    }
}

