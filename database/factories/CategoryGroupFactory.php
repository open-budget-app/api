<?php

use Faker\Generator as Faker;

$factory->define(App\CategoryGroup::class, function (Faker $faker) {
    $suffixes = [' expenses', ' payments', ' reserves'];
    $suffix = $suffixes[array_rand($suffixes)];
    return [
        'budget_id' => factory(\App\Budget::class)->create()->id,
        'name' => $faker->domainword . $suffix,
    ];
});
