<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    //
    protected $fillable = ["name", "slug"];

    public function getRouteKeyName()
    {
        return "slug";
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
