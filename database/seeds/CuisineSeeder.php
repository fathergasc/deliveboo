<?php

use App\Cuisine;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CuisineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $cuisines = [
            [
                'name' => 'italian',
                'image' => '/assets/img/cuisines/italian.jpg'
            ],
            [
                'name' => 'pizza',
                'image' => '/assets/img/cuisines/pizza.jpg'
            ],
            [
                'name' => 'greek',
                'image' => '/assets/img/cuisines/greek.jpg'
            ],
            [
                'name' => 'japanese',
                'image' => '/assets/img/cuisines/japanese.jpg'
            ],
            [
                'name' => 'chinese',
                'image' => '/assets/img/cuisines/chinese.jpg'
            ],
            [
                'name' => 'kebab',
                'image' => '/assets/img/cuisines/kebab.jpg'
            ],
            [
                'name' => 'mexican',
                'image' => '/assets/img/cuisines/mexican.jpg'
            ],
            [
                'name' => 'french',
                'image' => '/assets/img/cuisines/french.jpg'
            ],
        ];

        foreach ($cuisines as $cuisine) {
            Cuisine::query()->updateOrCreate([
                'name' => $cuisine['name'],
                'slug' => Str::slug($cuisine['name']),
                'image' => $cuisine['image'],
            ]);
    }
}
}
