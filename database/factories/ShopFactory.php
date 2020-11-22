<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Shop;
use App\User;
use Faker\Generator as Faker;

$factory->define(Shop::class, function (Faker $faker) {
    return [
        'title' => $faker->word(),
        'user_id' => function() {
            $user = factory(User::class)->create();
            return $user->id;
        }
    ];
});
