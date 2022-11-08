<?php

use App\Cuisine;
use Illuminate\Database\Seeder;

class CuisineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Cuisine::create([
            'name' => 'italiana',
            'slug' => Str::slug('italiana'),
        ]);

    }
}
