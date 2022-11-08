<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Restaurant;
use App\User;
use Illuminate\Support\Facades\Auth;

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
        //
    }

    public function store(Request $request)
    {
        //
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
}
