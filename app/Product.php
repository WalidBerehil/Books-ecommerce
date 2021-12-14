<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use Sortable;
    //
    protected $fillable = [
        "title", "slug", "description",
        "price", "old_price",
        "image", "inStock", "category_id", "author_id"
    ];

    public $sortable = [
        "id", "title", "slug", "description",
        "price", "old_price",
        "image", "inStock", "category_id", "author_id"
    ];

    public function getRouteKeyName()
    {
        return "slug";
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function Order_Product()
    {
        return $this->hasMany(Order_Product::class);
    }
}
