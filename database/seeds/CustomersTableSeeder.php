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
}
