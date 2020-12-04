<?php

/** @var Factory $factory */

use App\Shop;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Shop::class, function (Faker $faker) {
    return [
        'title' => $faker->word(),
        'description' => $faker->paragraph(15),
        'user_id' => function() {
            $user = factory(User::class)->create();
            return $user->id;
        }
    ];
});
