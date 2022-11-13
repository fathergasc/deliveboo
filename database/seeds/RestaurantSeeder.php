<?php

use App\Restaurant;
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

        $restaurants = [
            [
                'name' => 'Da Mario',
                'address' => 'via Torino, 5, Roma',
                'user_id' => '1',
            ],
            [
                'name' => 'Hellas',
                'address' => 'via Napoli, 23, Roma',
                'user_id' => '2',
            ],
            [
                'name' => 'Sakura',
                'address' => 'via Milano, 2, Roma',
                'user_id' => '3',
            ],
        ];

        foreach ($restaurants as $restaurant) {
            Restaurant::query()->updateOrCreate([
                'name' => $restaurant['name'],
                'slug' => Str::slug($restaurant['name']),
                'address' => $restaurant['address'],
                'user_id' => $restaurant['user_id'],
            ]);
        }
    }
}
