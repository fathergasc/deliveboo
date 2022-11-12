<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'image' => 'nullable|image|max:4000'
            ],
        );

        //recover authenticated user id
        $id = Auth::id();
        //get restaurant of authenticated user
        $userRestaurant = Restaurant::all()->where('user_id', $id)->first();

        $data = $request->all();

        if (array_key_exists('image', $data)) {
            Storage::delete($userRestaurant->image);
            $img_path = Storage::put('restaurant-image', $data['image']);
            $data['image'] = $img_path;
        }

        $userRestaurant->update($data);
        $userRestaurant->save();
        return redirect()->route('admin.home')->with('status', "Restaurant imaged uploaded");
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
