<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class InvoicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Invoice::class, 100)->create()->each(function ($u) {
            for($i=0;$i<3;$i++){
                $u->items()->save(factory(App\InvoiceItem::class)->make());
            }
        });
    }
}
