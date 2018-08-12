<?php

use Faker\Generator as Faker;

$factory->define(App\Budget::class, function (Faker $faker) {
    return [
        'name' => 'Budget of ' . $faker->unique()->firstName()
    ];
});
