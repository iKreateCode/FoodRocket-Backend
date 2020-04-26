<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\ItemExtra::class, function (Faker $faker) {
    return [
        'item_id' => App\Extras::all()->random()->id,
        'category_id' => App\ExtraCategory::all()->random()->id,
        'price' => $faker->randomFloat(2, 1, 10),
    ];
});
