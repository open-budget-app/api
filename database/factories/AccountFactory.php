<?php

use Faker\Generator as Faker;

$factory->define(App\Account::class, function (Faker $faker) {
    return [
        'budget_id' => factory(App\Budget::class)->create()->id,
        'name' => 'Budget ' . $faker->domainword
    ];
});
