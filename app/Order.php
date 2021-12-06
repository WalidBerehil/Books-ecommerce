<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        "user_id", "status", "qty",
        "price", "total",
        "paid", "delivered"
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function order_product()
    // {
    //     return $this->hasMany(Order_Product::class);
    // }

    public function order_product()
    {
        return $this->belongsTo(Order_Product::class);
    }
}
