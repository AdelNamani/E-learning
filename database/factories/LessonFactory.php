<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Lesson;
use Faker\Generator as Faker;

$factory->define(Lesson::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph,
        'video' => null,
        'support' => null,
        'chapter_id' => 1
    ];
});
