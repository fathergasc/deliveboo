<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuisine extends Model
{
    protected $fillable = ['name', 'slug'];

    public function restaurants() {
        return $this->belongsToMany('App\Restaurant');
    }

}
