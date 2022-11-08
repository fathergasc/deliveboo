<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_product')->insert(array(
            array('order_id' => 1, 'product_id' => 1, 'quantity' => 5),
            array('order_id' => 1, 'product_id' => 2, 'quantity' => 10),
        ));
    }
}
