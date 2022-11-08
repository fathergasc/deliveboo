<?php

use App\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Order::create([
            'name' => 'Mario Rossi',
            'phone' => '+39 3403468971',
            'email' => 'mariorossi@gmail.com',
            'shipping_address' => 'via Milano, 21, Roma',
            'paid' => "1"
        ]);
    }
}
