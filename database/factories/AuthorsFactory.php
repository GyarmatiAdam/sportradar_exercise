<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Authors;
use App\Books;
use Faker\Generator as Faker;

$factory->define(Authors::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'date_of_birth' => $faker->date,
        'address' => $faker->address,
    ];
});

$factory->define(Books::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'release_date' => $faker->date,
    ];
});
