<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\MenuItem::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence,
        'category_id' => null,
        'price' => $faker->randomFloat(2, 1, 10),
        'image_url' => $faker->imageUrl(200, 200),
    ];
});
