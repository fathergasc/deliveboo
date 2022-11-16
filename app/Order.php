<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'shipping_address', 'total_price', 'paid'];

    public function products() {
        return $this->belongsToMany('App\Product')->withPivot('quantity');
    }
}
