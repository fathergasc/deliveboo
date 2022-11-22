<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\OrderConfirmationCustomer;
use App\Mail\OrderConfirmationRestaurant;
use Illuminate\Http\Request;
use App\Order;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function orderHandle(Request $request)
    {
        ////// ADD PAYCHECK WITH BRAINTREE X ORDER->PAID //////

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

        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->email = $request->email;
        $order->shipping_address = $request->shipping_address;
        $order->total_price = $request->total_price;
        $order->paid = true;

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


        //get restaurant owner's email
        $resUserId = $request->resUserId;
        $resUser = User::where('id', $resUserId)->first();
        $resEmail = $resUser->email;

        //restaurant name
        $restaurant = $request->resName;

        Mail::to($request->email)->send(new OrderConfirmationCustomer($order, $restaurant));
        Mail::to($resEmail)->send(new OrderConfirmationRestaurant($order));

        return response()->json([
            'success' => true
        ]);
    }
}
