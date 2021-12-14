<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Author extends Model
{
    use Sortable;
    //
    protected $fillable = ["name", "slug"];

    public $sortable = ["id", "name", "slug", "created_at", "updated_at"];

    public function getRouteKeyName()
    {
        return "slug";
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
