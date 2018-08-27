<?php

use Illuminate\Database\Seeder;

class UserAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $string = file_get_contents(dirname(__FILE__)."/user-data.json");

        $json = json_decode($string, true);

        DB::table('user_addresses')->truncate();

            DB::table('user_addresses')->insert([
                'firstname' =>  $json['user']['firstname'],
                'lastname' =>  $json['user']['lastname'],
                'companyname' =>  $json['user']['companyname'],
                'street' => $json['user']['street'],
                'zipcode' => $json['user']['zipcode'],
                'city' => $json['user']['city'],
                'country' => $json['user']['country'],
                'email' => $json['user']['email'],
                'tel' => $json['user']['tel'],
                'iban' => $json['user']['iban'],
                'swift' => $json['user']['swift'],
                'bankname' => $json['user']['bankname'],
                'tax_id' => $json['user']['tax_id'],
            ]);
    }
}
