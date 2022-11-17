<?php

namespace App\Http\Controllers\Api;

use App\Cuisine;
use App\Http\Controllers\Controller;
use App\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = request()->all();

        if (array_key_exists('cuisines', $data)) {
            $restaurants = Restaurant::select('id', 'name', 'address', 'slug', 'image', 'user_id')
                ->with('cuisines')
                ->join('cuisine_restaurant', 'restaurants.id', '=', 'cuisine_restaurant.restaurant_id')
                ->whereIn('cuisine_restaurant.cuisine_id', $data['cuisines'])
                ->distinct() //prevents showing the same restaurant twice
                ->get();
        } else {
            $restaurants = Restaurant::with('cuisines')->get();
        }

        return response()->json(
            [
                'success' => true,
                'results' => $restaurants
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->with('products')->first();

        if($restaurant->image) {
            $restaurant->image = asset('storage/' .$restaurant->image);
        } else {
            $restaurant->image = asset('img/restaurant-picture-default.png');
        }

        return response()->json([
            'success' => true,
            'results' => $restaurant,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
