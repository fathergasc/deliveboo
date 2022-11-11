<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Restaurant;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
                'price' => 'required|numeric|between:0,9999',
                'displayed' => 'required|numeric|between:0,1',
                'image' => 'nullable|image|max:4000'
            ],
            [
                'displayed.between' => 'Invalid option for display product. Please select a valid option',
                'displayed.numeric' => 'Invalid option for display product. Please select a valid option'
            ]
        );

        //recover authenticated user id
        $id = Auth::id();
        //get restaurant of authenticated user
        $userRestaurant = Restaurant::all()->where('user_id', $id)->first();

        $data = $request->all();

        if (array_key_exists('image', $data)) {
            $img_path = Storage::put('product-image', $data['image']);
            $data['image'] = $img_path;
            }

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
        //calls the view function in ProductPolicy
        $this->authorize('view', $product);

        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        //calls the update function in ProductPolicy
        $this->authorize('update', $product);

        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        //calls the update function in ProductPolicy
        $this->authorize('update', $product);

        $request->validate(
            [
                'name' => 'required|max:100',
                'description' => 'required',
                'category' => 'max:70',
                'price' => 'required|numeric|between:0,9999',
                'displayed' => 'required|numeric|between:0,1',
                'image' => 'nullable|image|max:4000'
            ],
            [
                'displayed.between' => 'Invalid option for display product. Please select a valid option',
                'displayed.numeric' => 'Invalid option for display product. Please select a valid option'
            ]
        );


        $id = Auth::id();

        $userRestaurant = Restaurant::all()->where('user_id', $id)->first();

        $data = $request->all();

        if (array_key_exists('image', $data)) {
            Storage::delete($product->image);
            $img_path = Storage::put('product-image', $data['image']);
            $data['image'] = $img_path;
        }

        if($product->name !== $data['name']) {
            $data['slug'] = $this->generateSlug($data['name']);
        }

        $product->update($data);

        $slug = $this->generateSlug($product->name);
        $product->slug = $slug;

        $product->restaurant_id = $userRestaurant->id;
        $product->save();

        return redirect()->route('admin.products.index')->with('status', 'Product updated!');
    }

    public function destroy(Product $product)
    {
        //calls the delete function in ProductPolicy
        $this->authorize('delete', $product);

        $product->delete();
        return redirect()->route('admin.products.index')->with('status', 'Product deleted!');
    }


    //CUSTOM FUNCTIONS

    //generate unique slug for products
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

    public function deleteProductImage(Product $product) {
        if ($product->image) {
            Storage::delete($product->image);
        };

        $product->image = null;
        $product->save();

        return redirect()->route('admin.products.edit', ['product' => $product->slug])->with('status', 'Product image deleted!');
    }

    //function to protect routes without a Policy - not in use
    public function protectProductRoutes($product) {
        //recover authenticated user id
        $id = Auth::id();
        //get restaurant of authenticated user
        $userRestaurant = Restaurant::all()->where('user_id', $id)->first();

        if($product->restaurant_id != $userRestaurant->id) {
            abort(403, "Unauthorized access");
        }
    }
}
