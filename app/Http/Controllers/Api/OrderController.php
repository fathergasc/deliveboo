<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;

class OrderController extends Controller
{
    public function orderHandle(Request $request) {
        ///// ADD VALIDATE E PAYCHECK /////

        $data = $request->json()->all();

        $order = new Order;
        $order->fill($data);
        $order->save();

        return response()->json([
            'success' => true
        ]);
    }
}
