<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\Viewable;
use \Spatie\Tags\HasTags;
use App\Category;
use App\Realm;
use App\SubCategory;
use Laravel\Scout\Searchable;
use Cviebrock\EloquentSluggable\Sluggable;


class Post extends Model
{
    use \Spatie\Tags\HasTags;
    use Viewable,Searchable,Sluggable;
    public $table = 'posts';

    public $fillable = ['title','body','price_description','price','delivery_time','requirements','image','username'];
    public $primaryKey ='id';

    public $timestamps = true;

    
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function userName(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function realm(){
        return $this->belongsToMany('App\Realm');
    }
    
    public function subcat(){
        return $this->belongsTo(SubCategory::class);
    }

    public function review(){
        return $this->belongsToMany(Review::class)->withPivot('post_id','review_id');
    }

    public function question(){
        return $this->belongsToMany(Question::class)->withPivot('post_id','question_id');
    }
        /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
