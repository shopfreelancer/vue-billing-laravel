<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Model::unguard();
        $this->call(CustomersTableSeeder::class);
        $this->call(InvoicesTableSeeder::class);
        $this->call(UsersSeeder::class);
        //Model::reguard();
    }
}
