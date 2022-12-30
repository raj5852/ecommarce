<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    //
    function index()
    {
        return view('admin.category.index');
    }
    function create()
    {
        return view('admin.category.create');
    }
    function store(CategoryFormRequest $request)
    {
        $validatedData = $request->validated();
        $category = new Category();
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->description = $validatedData['description'];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/category/', $filename);
            $category->image = 'uploads/category/' . $filename;
        }

        $category->meta_title = $validatedData['meta_title'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->meta_description = $validatedData['meta_description'];

        $category->status = $request->status == true ? '1' : '0';
        $category->save();
        return redirect('admin/category')->with('message', 'Category Added Successfully');
    }
    function edit(Category $category){
         $category->image;
        return view('admin.category.edit',compact('category'));
    }
    function update(CategoryFormRequest $request, $category){
          $category = Category::findOrFail($category);


         $validatedData = $request->validated();
         $category->name = $validatedData['name'];
         $category->slug = Str::slug($validatedData['slug']);
         $category->description = $validatedData['description'];

         if ($request->hasFile('image')) {

            $path = $category->image;

            if(File::exists($path)){
                File::delete($path);
            }

             $file = $request->file('image');
             $ext = $file->getClientOriginalExtension();
             $filename = time() . '.' . $ext;
             $file->move('uploads/category/', $filename);
             $category->image = 'uploads/category/' . $filename;
         }

         $category->meta_title = $validatedData['meta_title'];
         $category->meta_keyword = $validatedData['meta_keyword'];
         $category->meta_description = $validatedData['meta_description'];

         $category->status = $request->status == true ? '1' : '0';
         $category->update();
         return redirect('admin/category')->with('message', 'Category Updated Successfully');
    }
}
