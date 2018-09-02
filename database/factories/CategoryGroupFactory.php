<?php

use Faker\Generator as Faker;

$factory->define(App\CategoryGroup::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->randomElement([
            'Fixed Expenses',
            'True Expenses',
            'Debt Payments',
            'Long term Reserves',
            'Fun money',
        ]),
    ];
});
