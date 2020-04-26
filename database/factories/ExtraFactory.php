<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Extras::class, function (Faker $faker) {
    return [
        'category_id' => App\ExtraCategory::all()->random()->id,
        'name' => $faker->name,
        'description' => $faker->sentence,
        'price' => $faker->randomFloat(2, 1, 10),
        'image_url' => $faker->imageUrl(200, 200),
    ];
});
