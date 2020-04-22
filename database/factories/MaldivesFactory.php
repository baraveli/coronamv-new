<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Maldives;
use Faker\Generator as Faker;

$factory->define(Maldives::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'administrative_atoll' => $faker->word,
        'confirmed' => $faker->word,
        'recovered' => $faker->word,
        'deaths' => $faker->word,
        'active' => $faker->word,
        'lat' => $faker->word,
        'long' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
