<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    function products(){
       return  $this->hasMany(Product::class)->latest();
    }
    function brands(){
        return $this->hasMany(Brand::class)->where('status',0);
    }
}
