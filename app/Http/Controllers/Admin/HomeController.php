<?php

namespace App\Http\Controllers\Admin;

// default
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

// models
use App\Restaurant;
use App\Cuisine;

class HomeController extends Controller
{
    public function index(){

        
        // recover authenticated user id
        $id = Auth::id();

        //get restaurant of authenticated user
        $restaurant = Restaurant::all()->where('user_id', $id)->first();
        $cuisines = $restaurant->cuisines->all();

        return view('admin.home', compact('restaurant', 'cuisines'));
    }

    public function checkAuth(){
        $auth = Auth::id();

        if ($auth) {
            return response()->json([
                'success' => true
            ]);
        }
    }

}
