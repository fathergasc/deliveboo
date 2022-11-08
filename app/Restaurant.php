<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = ['name', 'address', 'slug', 'image', 'user_id'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function cuisines() {
        return $this->belongsToMany('App\Cuisine');
    }

    public function products() {
        return $this->hasMany('App\Product');
    }
}
