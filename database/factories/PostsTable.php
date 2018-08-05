<?php

use Faker\Generator as Faker;
use App\Category;
use App\SubCategory;
$factory->define(Post::class, function (Faker $faker) {
    return [
            'title'=>  $faker->text($maxNbChars = 40),
            'category_id'=> $faker->numberBetween($min = 1, $max = 8),
            'subcat_id' => $faker->numberBetween($min = 1, $max = 27),
            'cat_name'=> Category::where('id',$faker->numberBetween($min = 1, $max = 8))->value('name'),
            'subcat_name' => SubCategory::where('id',$faker->numberBetween($min = 1, $max = 27))->value('name'),
            'user_id'=> 5,
            'username'=> 'goodie',
            'price_description'=>$faker->text($minNbChars= 20,$maxNbChars = 115),
            'price'=>$faker->numberBetween($min = 5, $max = 995),
            'delivery_time'=>$faker->numberBetween($min = 1, $max = 30),
            'body'=>$faker->text($minNbChars= 120,$maxNbChars = 1200),
            'requirements'=>$faker->text($minNbChars= 20,$maxNbChars = 115),
    ];
});
