<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\Restaurant;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function index()
    {
<<<<<<< HEAD
        
=======
        /*
        //recover authenticated user id
        $id = Auth::id();
        $user = Auth::user();

        //get restaurant of authenticated user
        $userRestaurant = Restaurant::all()->where('user_id', $id)->first();
        //dd($userRestaurant->id);

        //get all products from the restaurant of the authenticated user
        $products = Product::all()->where('restaurant_id', $userRestaurant->id);

        $userData = User::with('restaurants.products.orders')->where('id', $id)->get()->toArray();
        dd($orders); */

        $orders = Order::all();

        return view('admin.orders.index', compact('orders'));
>>>>>>> 690ea9db6af16c4c9fc109d903cb8a9b0abbfef3
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
