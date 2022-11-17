<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function orderHandle(Request $request)
    {
        ///// ADD VALIDATE E PAYCHECK /////

        $data = $request->json()->all();

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50',
            'phone' => 'required|numeric|digits_between:5,25',
            'email' => 'required|email',
            'shipping_address' => 'required|string|min:3|max:50',
            'total_price' => 'required|numeric',
        ]);

        if($validator->fails()) {
            return response()->json (
                [
                    'success' => false,
                    'errors' => $validator->errors()
                ]
                );
        }

        $order = new Order;

        //$order-paid = // ADD BRAINTREE

        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->email = $request->email;
        $order->shipping_address = $request->shipping_address;
        $order->total_price = $request->total_price;

        $order->save();

        $cartItems = [];
        $quantityItems = [];

        foreach ($request->liveCart as $item) {
            $cartItems[] = $item['id'];
            $quantityItems[] = $item['productCounter'];
        }

        $sync_data = [];
        for ($i = 0; $i < count($cartItems); $i++) {
            $sync_data[$cartItems[$i]] = ['quantity' => $quantityItems[$i]];
        }

        $order->products()->sync($sync_data);

        return response()->json([
            'success' => true
        ]);
    }
}
