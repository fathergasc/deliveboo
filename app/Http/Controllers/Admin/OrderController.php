<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\Restaurant;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
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



        //$orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
