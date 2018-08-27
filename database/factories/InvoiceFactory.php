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

$factory->define(App\Invoice::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'invoice_number' => $faker->randomNumber(5),
        'customer_address' => $faker->address,
        'text_top' => $faker->sentence(8),
        'text_bottom' => $faker->sentence(4),
        'date' => $faker->date(),
        'customer_id' => rand(1,50),
    ];
});

