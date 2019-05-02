<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Question;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    return [
        'statement' => $faker->sentence,
        'chapter_id' => 1,
        //'proposition_id' => rand(1,30)
    ];
});
