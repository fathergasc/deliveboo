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

        $cuisines = ['italian', 'french', 'greek', 'japanese', 'chinese', 'indian', 'mexican'];

        foreach ($cuisines as $cuisine) {
            $newCuisine = new Cuisine();
            $newCuisine->name = $cuisine;
            $newCuisine->slug = Str::slug($cuisine);
            $newCuisine->save();
        }

    }
}
