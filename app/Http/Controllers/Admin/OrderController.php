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
        //recover authenticated user id
        $id = Auth::id();
        $user = User::find($id);

        //get restaurant of authenticated user
        $restaurant = Restaurant::all()->where('user_id', $id)->first();
        $products = Product::all()->where('restaurant_id', $restaurant->id);

        $orders = [];
        $ordersIds = [];
        foreach($products as $product){
            foreach($product->orders as $order){
                if(!in_array($order->id, $ordersIds)) {
                    $ordersIds[] = $order->id;
                    $orders[] = $order;
                }
            }
        }

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
        //calls the view function in OrderPolicy
        $this->authorize('view', $order);

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


    //function to protect order routes without a Policy - not in use
    public function protectOrderRoutes($order) {
        //recover authenticated user id
        $id = Auth::id();
        //get restaurant of authenticated user
        $userRestaurant = Restaurant::all()->where('user_id', $id)->first();
        $products = Product::all()->where('restaurant_id', $userRestaurant->id);

        $orders = [];
        $ordersIds = [];
        foreach($products as $product){
            foreach($product->orders as $order){
                if(!in_array($order->id, $ordersIds)) {
                    $ordersIds[] = $order->id;
                    $orders[] = $order;
                }
            }
        }

        if(!in_array($order->id, $ordersIds )) {
            abort(403, "Unauthorized access");
        }
    }
}
