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

$factory->define(App\Customer::class, function (Faker $faker) {
    return [
        'company' => $faker->company,
        'firstname' => $faker->firstname,
        'lastname' => $faker->lastname,
        'email' => $faker->unique()->safeEmail,
        'street' => $faker->streetAddress,
        'zipcode' => $faker->postcode,
        'city' => $faker->country,
        'country' => $faker->country,
        'tel' => $faker->phoneNumber,
        'note' => $faker->sentence
    ];
});
