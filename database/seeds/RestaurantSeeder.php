<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Restaurant::create([
            'name' => 'Da Mario',
            'address' => 'via Roma, 12, Roma',
            'slug' => Str::slug('Da Mario'),
            'user_id' => '1',
        ]);

        App\Restaurant::create([
            'name' => 'Da Mario 2',
            'address' => 'via Milano, 24, Roma',
            'slug' => Str::slug('Da Mario 2'),
            'user_id' => '1',
        ]);
    }
}
