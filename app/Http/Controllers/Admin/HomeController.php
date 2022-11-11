<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index(){

        //recover authenticated user id
        $id = Auth::id();

        //get restaurant of authenticated user
        $restaurant = Restaurant::all()->where('user_id', $id)->first();
        //dd($userRestaurant->id);

        return view('admin.home', compact('restaurant'));
    }

}
