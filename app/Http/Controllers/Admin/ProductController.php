<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Restaurant;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        //recover authenticated user id
        $id = Auth::id();

        //get restaurant of authenticated user
        $userRestaurant = Restaurant::all()->where('user_id', $id)->first();
        //dd($userRestaurant->id);

        //get all products from the restaurant of the authenticated user
        $products = Product::all()->where('restaurant_id', $userRestaurant->id);


        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:100',
                'description' => 'required',
                'category' => 'max:70',
                'price' => 'required|numeric|between:0,9999'
            ]
        );

        //recover authenticated user id
        $id = Auth::id();
        //get restaurant of authenticated user
        $userRestaurant = Restaurant::all()->where('user_id', $id)->first();

        $data = $request->all();
        $product = new Product();
        $product->fill($data);
        //create a unique slug from product name
        $slug = $this->generateSlug($product->name);
        $product->slug = $slug;
        //end slug method
        $product->restaurant_id = $userRestaurant->id;
        $product->save();

        return redirect()->route('admin.products.index')->with('status', 'Product added!');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        // $products = Product::find('id');
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate(
            [
                'name' => 'required|max:100',
                'description' => 'required',
                'category' => 'max:70',
                'price' => 'required|numeric|between:0,9999'
            ]
        );


        $id = Auth::id();

        $userRestaurant = Restaurant::all()->where('user_id', $id)->first();

        $data = $request->all();
        $product->update($data);

        $slug = $this->generateSlug($product->name);
        $product->slug = $slug;

        $product->restaurant_id = $userRestaurant->id;
        $product->save();

        return redirect()->route('admin.products.index')->with('status', 'Product added!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('status', 'Product deleted!');
    }

    protected function generateSlug($name) {
        $slug = Str::slug($name, '-');
        $checkProduct = Product::all()->where('slug', $slug)->first();
        $counter = 1;
        while($checkProduct) {
            $slug = Str::slug($name . '-' . $counter, '-');
            $counter++;
            $checkProduct = Product::all()->where('slug', $slug)->first();
        }

        return $slug;
    }
}
