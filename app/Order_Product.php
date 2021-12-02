<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_Product extends Model
{
    //
    protected $fillable = [
        "order_id", "product_id", "qty",
        "price"
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class,'orders_products','products_id','order_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,'orders_products','order_id','products_id');
    }
}
