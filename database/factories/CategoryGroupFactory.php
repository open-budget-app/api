<?php

use Faker\Generator as Faker;

$factory->define(App\CategoryGroup::class, function (Faker $faker) {
    $suffix = array_rand([' expenses', ' payments', ' reserves']);
    return [
        'budget_id' => factory(\App\Budget::class)->create()->id,
        'name' => $faker->domainword . $suffix,
    ];
});
