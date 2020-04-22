<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Test;
use Faker\Generator as Faker;

$factory->define(Test::class, function (Faker $faker) {

    return [
        'total_tested' => $faker->randomDigitNotNull,
        'total_positive' => $faker->randomDigitNotNull,
        'total_negative' => $faker->randomDigitNotNull,
        'total_pending' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
