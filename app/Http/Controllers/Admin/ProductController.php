<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    //
    function index(){
        return view('admin.products.index');
    }
    function create(){
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.create',compact('categories','brands'));
    }
    function store(ProductFormRequest $request){
        $validateData = $request->validated();

        $category = Category::findOrFail($validateData['category_id']);

        $product = $category->products()->create([
           'category_id'=> $validateData['category_id'],
           'name'=> $validateData['name'],
           'slug'=> Str::slug($validateData['slug']),
           'brand'=> $validateData['brand'],
           'small_description'=>$validateData['small_description'],
           'description'=>$validateData['description'],
           'original_price'=> $validateData['original_price'],
           'selling_price'=> $validateData['selling_price'],
           'quantity'=> $validateData['quantity'],
           'trending'=>$request->trending == true?'1':'0',
           'status'=>$request->status == true?'1':'0',
           'meta_title'=>$validateData['meta_title'],
           'meta_keyword'=>$validateData['meta_keyword'],
           'meta_description'=>$validateData['meta_description'],
        ]);

        if($request->hasFile('image')){
            $uploadPath = 'uploads/products/';
            $i = 1;
            foreach($request->file('image') as $imageFile){
                $extension = $imageFile->getClientOriginalExtension();
                $filename =  time().$i++.'.'. $extension;
                $imageFile->move($uploadPath,$filename);
                $finalImagePathName = $uploadPath.$filename;

                $product->productImages()->create([
                    'product_id'=> $product->id,
                    'image'=>$finalImagePathName
                ]);
            }
        }
        return redirect('admin/products')->with('message','Product Added  successfully');



    }
}
