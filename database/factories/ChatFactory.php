<?php

use Faker\Generator as Faker;

$factory->define(App\Chat::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween($min = 5, $max = 11),
        'contact_id' => $faker->numberBetween($min = 5, $max = 11),
        'chat' => $faker->text($maxNbChars = 150)
    ];
});
