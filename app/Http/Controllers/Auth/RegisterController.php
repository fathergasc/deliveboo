<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Restaurant;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'vat_number' => ['required', 'string', 'min:11', 'max:11'],
            'restaurant_name' => ['required', 'string', 'max:70'],
            'address' => ['required', 'string', 'max:80']
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
        Restaurant::create([
            'name' => $data['restaurant_name'],
            'address' => $data['address'],
            'slug' => Str::slug($data['restaurant_name']),
            'user_id' => $userId,
        ]);
        return $user;
    }
}
