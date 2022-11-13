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

        $restaurants = Restaurant::with('cuisines')->get();
        return response()->json(
            [
                'success' => true,
                'results' => $restaurants
            ]
        );
        /*
        $data = request()->all();

        if(array_key_exists('cuisine', $data)) {
            $cuisines = Cuisine::find($data['cuisine']);
            $restaurants = $cuisines->restaurants->all();
        } else {
            $restaurants = Restaurant::with('cuisines')->get();
        }
        return response()->json([
            'success' => true,
            'results' => $restaurants
        ]);

        /*$data = request()->all();
        if(array_key_exists('cuisines', $data)) {
            $restaurants = Restaurant::with('cuisines')->where('cuisines->id', $data['cuisines'])->get();
        } else {
            $restaurants = Restaurant::with('cuisines')->get();
        }

        return response()->json(
            [
                'success' => true,
                'results' => $restaurants,
            ]
            );
            */

        /*
            $data = request()->all();
            if(array_key_exists('cuisines', $data)) {
                $restaurants = Restaurant::with('cuisines')->get();

                $restaurants = $restaurants->cuisines->get()->pivot->cuisine_id
                //$restaurants = Restaurant::with('cuisines')->pivot->cuisine_id->where('cuisines_id', $data['cuisines'])->get();
            }  else {
                $restaurants = Restaurant::with('cuisines')->get();
            }
            return response()->json(
                [
                    'success' => true,
                    'results' => $restaurants,
                ]
                );

                */
    }

    public function filterRestaurants()
    {
        $data = request()->all();

        //if(array_key_exists('cuisines', $data)) {
        $restaurants = Restaurant::select('name', 'address', 'slug', 'image', 'id')
            ->join('cuisine_restaurant', 'restaurant.id', '=', 'cuisine_restaurant.restaurant_id')
            ->whereIn('cuisine_restaurant.cuisine_id', $data['cuisines'])
            ->with('cuisines')
            ->get();
        //}


        return response()->json(
            [
                'success' => true,
                'results' => $restaurants,
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
    public function show($id)
    {
        //
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
