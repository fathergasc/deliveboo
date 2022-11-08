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
        ));
    }
}
