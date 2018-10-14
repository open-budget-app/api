<?php

use Faker\Generator as Faker;

$factory->define(App\CategoryGroup::class, function (Faker $faker) {
    return [
        'budget_id' => factory(\App\Budget::class)->create()->id,
        'name' => $faker->unique()->randomElement([
            'Fixed Expenses',
            'True Expenses',
            'Debt Payments',
            'Long term Reserves',
            'Fun money',
        ]),
    ];
});
