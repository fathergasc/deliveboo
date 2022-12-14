<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'price', 'image', 'displayed', 'category', 'restaurant_id'];

    public function restaurant() {
        return $this->belongsTo('App\Restaurant');
    }

    public function orders() {
        return $this->belongsToMany('App\Order')->withPivot('quantity');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
