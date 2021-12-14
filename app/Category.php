<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Category extends Model
{
    use Sortable;
    //
    protected $fillable = ["title", "slug"];

    public $sortable = ["id", "title", "slug", "created_at", "updated_at"];

    public function getRouteKeyName()
    {
        return "slug";
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
