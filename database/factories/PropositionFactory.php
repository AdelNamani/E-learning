<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Proposition;
use Faker\Generator as Faker;

$factory->define(Proposition::class, function (Faker $faker) {
    return [
        'statement' => $faker->sentence,
        'question_id' => rand(1,10),
        'is_correct' => $faker->boolean
    ];
});
