<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = ['description','id','code','value'];


    public function category()
    {
        return $this->hasMany('App\ProductCategory')->join('categories','categories.id','=','product_categories.category_id');

    }

}
