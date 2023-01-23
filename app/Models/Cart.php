<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = [];

    function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    function productColor(){
        return $this->belongsTo(ProductColor::class,'product_color_id','id');
    }
}
