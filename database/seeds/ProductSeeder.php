<?php

use App\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Product::truncate();

        $json = Storage::disk('local')->get("json/productsData.json");
        $products = json_decode($json, true);

        foreach ($products as $product) {
            Product::query()->updateOrCreate([
                'name' => $product['name'],
                'slug' => Str::slug($product['name']),
                'description' => $product['description'],
                'price' => $product['price'],
                'displayed' => $product['displayed'],
                'category' => $product['category'],
                'restaurant_id' => $product['restaurant_id'],
            ]);
        }
    }
}
