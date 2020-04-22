<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ResourceFilter;
use Faker\Generator as Faker;

$factory->define(ResourceFilter::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'sub' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
