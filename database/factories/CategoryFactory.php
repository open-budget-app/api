<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->randomElement([
            'Rent',
            'Internet',
            'Groceries',
            'Electricity Bill',
            'Tap Water Bill',
            'Electronics',
            'Car Maintenance',
            'Home Maintenance',
            'House Insurance',
            'Medical Insurance',
            'Clothing',
            'Software Subscriptions',
            'Holidays',
            'Presents',
            'Home decoration',
        ])
    ];
});
