<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    $suffixes = [' maintenance', ' bill', ' insurance'];
    $suffix = $suffixes[array_rand($suffixes)];
    return [
        'category_group_id' => factory(\App\CategoryGroup::class)->create()->id,
        'name' =>  $faker->domainword . $suffix
    ];
});
