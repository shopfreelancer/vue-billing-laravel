<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Ticket::class, function (Faker $faker) {
    return [
        'title' => $faker->realText($maxNbChars = 20, $indexSize = 2),
        'description' => $faker->sentence(4),
        'hours' => $faker->numberBetween($min = 0, $max = 14),
        'minutes' => $faker->numberBetween($min = 0, $max = 59),

    ];
});
