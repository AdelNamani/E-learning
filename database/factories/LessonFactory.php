<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Lesson;
use Faker\Generator as Faker;

$factory->define(Lesson::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'video' => 'https://www.youtube.com/watch?v=BYSoHnQ3Ux0',
        'chapter_id' => rand(1,20)
    ];
});
