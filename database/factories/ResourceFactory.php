<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Resource;
use Faker\Generator as Faker;

$factory->define(Resource::class, function (Faker $faker) {

    return [
        'title' => $faker->word,
        'body' => $faker->text,
        'resource_embed_image' => $faker->word,
        'resource_link' => $faker->word,
        'resources_filter_id' => $faker->randomDigitNotNull,
        'contact' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
