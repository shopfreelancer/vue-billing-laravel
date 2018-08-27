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

$factory->define(App\InvoiceItem::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'description' => $faker->text,
        'price' => $faker->randomFloat(NULL,1,999),
        'tax_rate' => '19'
    ];
});
