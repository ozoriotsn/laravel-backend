<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    protected $fillable = ['description','id','product_count'];


    public function product()
    {
        return $this->hasOne('App\ProductCategory')->selectRaw('category_id, count(*) as count')->groupBy('category_id');
    }
}
