<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'author_name' => $faker->name,
        'date_of_borth' => $faker->date,
        'author_address' => $faker->address,
    ];
});
