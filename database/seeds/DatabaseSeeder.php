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
        // $this->call(UsersTableSeeder::class);
        $this->call(FirstUserSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(CuisineSeeder::class);
        $this->call(RestaurantSeeder::class);
        $this->call(CuisineRestaurantSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(OrderProductSeeder::class);

    }
}
