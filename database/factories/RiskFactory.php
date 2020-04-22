<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Risk;
use Faker\Generator as Faker;

$factory->define(Risk::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'en_name' => $faker->word,
        'alert' => $faker->word,
        'level' => $faker->word,
        'class' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
