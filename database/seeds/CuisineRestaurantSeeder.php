<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CuisineRestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('cuisine_restaurant')->insert(array(
            array('cuisine_id' => 1, 'restaurant_id' => 1),
            array('cuisine_id' => 2, 'restaurant_id' => 1),
            array('cuisine_id' => 3, 'restaurant_id' => 2),
            array('cuisine_id' => 4, 'restaurant_id' => 3),
            array('cuisine_id' => 5, 'restaurant_id' => 3),
        ));
    }
}
