<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    $suffix = array_rand([' maintenance', ' bill', ' insurance']);
    return [
        'category_group_id' => factory(\App\CategoryGroup::class)->create()->id,
        'name' =>  $faker->domainword . $suffix
    ];
});
