<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Commodity;
use Faker\Generator as Faker;

$factory->define(Commodity::class, function (Faker $faker) {
    return [
        'title' => $faker->word(),
    ];
});
