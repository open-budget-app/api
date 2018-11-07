<?php

use Faker\Generator as Faker;

$factory->define(App\CategoryBudget::class, function (Faker $faker) {
    return [
        'amount' => rand(100, 1000),
        'year_month' => \Carbon\Carbon::now(),
        'category_id' => factory(\App\Category::class)->create()->id
    ];
});
