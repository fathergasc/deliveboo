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

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
