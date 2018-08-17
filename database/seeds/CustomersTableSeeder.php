<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Customer::class, 50)->create()->each(function ($u) {
            $u->tickets()->save(factory(App\Ticket::class)->make());
            $u->tickets()->save(factory(App\Ticket::class)->make());
        });
    }

    public function generateSingleShopwareCustomerFake(){

        $faker = \Faker\Factory::create();

        $email = $faker->email;
        $firstname = $faker->firstName;
        $lastname = $faker->lastname;

        $data = [
            'email'         => $email,
            'firstname'     => $firstname,
            'lastname'      => $lastname,
            'salutation' => 'mr',
            'billing' => [
                'email'         => $email,
                'firstname'     => $firstname,
                'lastname'      => $lastname,
                'salutation' => 'mr',
                'city'          => $faker->city,
                'zipcode'      => $faker->postcode,
                'street'        => $faker->streetName." ".$faker->streetAddress,
                'country' => 2
            ]

        ];
        return $data;
    }
}
