<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Restaurant;
use App\User;
use App\Cuisine;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $cuisines = Cuisine::orderBy('name')->get();
        $data = [
            'cuisines' => $cuisines
        ];
        return view("auth.register")->with($data);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'vat_number' => ['required', 'string', 'min:11', 'max:11', 'unique:users'],
            'restaurant_name' => ['required', 'string', 'max:70'],
            'address' => ['required', 'string', 'max:80'],
            'cuisine_id' => ['required', 'numeric', 'exists:cuisines,id']
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'vat_number' => $data['vat_number']
        ]);

        //recover user id to assign it to the restaurant
        $userId = $user->id;
        $restaurant = Restaurant::create([
            'name' => $data['restaurant_name'],
            'address' => $data['address'],
            'slug' => Str::slug($data['restaurant_name']),
            'user_id' => $userId,
        ]);

        //recover restaurant id and the cuisine_id to assign them to the cuisine_restaurant table
        $restaurantId = $restaurant->id;

        DB::table('cuisine_restaurant')->insert(array(
            array('cuisine_id' => $data['cuisine_id'], 'restaurant_id' => $restaurantId),
        ));
        return $user;
    }

}
