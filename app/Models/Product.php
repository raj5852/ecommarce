<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded  = [];

    function categories(){
        return $this->belongsTo(Category::class,'category_id');
    }

    function productImages(){
        return $this->hasMany(ProductImage::class);
    }

    function productColors(){
        return $this->hasMany(ProductColor::class,'product_id','id');
    }
}
