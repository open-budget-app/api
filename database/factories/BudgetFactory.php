<?php

use Faker\Generator as Faker;

$factory->define(App\Budget::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\User::class)->create()->id,
        'name' => 'Budget of ' . $faker->unique()->firstName()
    ];
});
