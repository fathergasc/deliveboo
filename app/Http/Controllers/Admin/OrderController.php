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
