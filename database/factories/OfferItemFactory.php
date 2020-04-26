<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\OfferItem::class, function (Faker $faker) {
    return [
        'offer_id' => App\Offer::all()->random()->id,
        'item_id' => App\MenuItem::all()->random()->id,
        'price' => $faker->randomFloat(2, 1, 10),
        'quantity' => $faker->randomNumber(),
    ];
});
