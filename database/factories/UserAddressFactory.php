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

$factory->define(App\UserAddress::class, function (Faker $faker) {
    return [
        'companyname' => $faker->company,
        'firstname' => $faker->firstname,
        'lastname' => $faker->lastname,
        'email' => $faker->unique()->safeEmail,
        'street' => $faker->streetAddress,
        'zipcode' => $faker->postcode,
        'city' => $faker->country,
        'country' => $faker->country,
        'tel' => $faker->phoneNumber,
        'iban' => $faker->word,
        'swift' => $faker->word,
        'bankname' => $faker->word,
        'tax_id' => $faker->word,
    ];
});
