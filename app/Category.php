<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Spatie\Tags\HasTags;
use Laravel\Scout\Searchable;
use App\SubCategory;

class Category extends Model
{
    use Searchable;
    public $table = 'categories';
    public $primaryKey ='id';
    
    public $fillable = ['name'];

    public function posts(){
        return $this->hasMany(Post::class);
    }
    public function subCat(){
        return $this->hasMany(SubCategory::class);
    }
}
