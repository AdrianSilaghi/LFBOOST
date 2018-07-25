<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use App\Category;

class SubCategory extends Model
{
    use Searchable;
    public $table = 'subcategories';
    public $primaryKey ='id';
    
    public $fillable = ['name'];
    
    public function category(){

        return $this->belongsTo(Category::class);
    }
    public function posts(){
        
        return $this->hasMany(Post::class);
    }
}
