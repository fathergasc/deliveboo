<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'shipping_address', 'paid', 'category'];

    public function products() {
        return $this->belongsToMany('App\Product')->withPivot('quantity');
    }
}
