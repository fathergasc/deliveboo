<?php

namespace App\Policies;

use App\Product;
use App\Restaurant;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Product  $product
     * @return mixed
     */
    public function view(User $user, Product $product)
    {
        //if the function returns true, the user is authorized
        
        $userRestaurant = Restaurant::all()->where('user_id', $user->id)->first();

        return $product->restaurant_id == $userRestaurant->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, Product $product)
    {
        //if the function returns true, the user is authorized

        $userRestaurant = Restaurant::all()->where('user_id', $user->id)->first();

        return $product->restaurant_id == $userRestaurant->id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Product  $product
     * @return mixed
     */
    public function update(User $user, Product $product)
    {
        //if the function returns true, the user is authorized

        $userRestaurant = Restaurant::all()->where('user_id', $user->id)->first();

        return $product->restaurant_id == $userRestaurant->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Product  $product
     * @return mixed
     */
    public function delete(User $user, Product $product)
    {
        //if the function returns true, the user is authorized

        $userRestaurant = Restaurant::all()->where('user_id', $user->id)->first();

        return $product->restaurant_id == $userRestaurant->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Product  $product
     * @return mixed
     */
    public function restore(User $user, Product $product)
    {
        //if the function returns true, the user is authorized

        $userRestaurant = Restaurant::all()->where('user_id', $user->id)->first();

        return $product->restaurant_id == $userRestaurant->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Product  $product
     * @return mixed
     */
    public function forceDelete(User $user, Product $product)
    {
        //if the function returns true, the user is authorized

        $userRestaurant = Restaurant::all()->where('user_id', $user->id)->first();

        return $product->restaurant_id == $userRestaurant->id;
    }
}
