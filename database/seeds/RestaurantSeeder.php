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
            [
                'name' => 'Tian Tian',
                'address' => 'via Verona, 50, Roma',
                'user_id' => '4',
            ],
            [
                'name' => 'Istanbul Kebab',
                'address' => 'via Cavour, 24, Roma',
                'user_id' => '5',
            ],
            [
                'name' => 'La Vera Napoletana',
                'address' => 'via delle Vestali, 7, Roma',
                'user_id' => '6',
            ],
            [
                'name' => 'La Cucaracha',
                'address' => 'via Catanzaro, 12, Roma',
                'user_id' => '7',
            ],
            [
                'name' => 'Le Parisien',
                'address' => 'via Lucullo, 4, Roma',
                'user_id' => '8',
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
