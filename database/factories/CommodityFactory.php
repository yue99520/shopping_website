<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Commodity;
use Faker\Generator as Faker;

$factory->define(Commodity::class, function (Faker $faker) {
    return [
        'title' => $faker->word(),
        'description' => $faker->paragraph(10),
        'price' => $faker->numberBetween(1, 10000),
        'remaining_amount' => $faker->numberBetween(1, 200),
        'sold_amount' => $faker->numberBetween(1, 200),
        'unit_string' => '個',
    ];
});
