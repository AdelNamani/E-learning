<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Chapter;
use Faker\Generator as Faker;

$factory->define(Chapter::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        // 'description' => $faker->paragraph,
        // 'video' => null,
        // 'support' => null,
        'course_id' => 1
    ];
});
