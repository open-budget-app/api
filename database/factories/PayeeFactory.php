<?php

use Faker\Generator as Faker;

$factory->define(App\Payee::class, function (Faker $faker) {
    return [
        'budget_id' => factory(App\Budget::class)->create()->id,
        'name' => 'Payee ' . $faker->domainword,
    ];
});
