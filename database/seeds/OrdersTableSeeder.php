<?php

use Illuminate\Database\Seeder;

/**
 * Class OrdersTableSeeder
 */
class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Order::class, 20)->create();
    }
}
