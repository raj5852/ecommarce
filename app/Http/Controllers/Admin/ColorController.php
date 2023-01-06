<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorFormRequest;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    //
    function  index(){
        $colors = Color::all();
        return view('admin.colors.index',compact('colors'));
    }
    function create(){
        return view('admin.colors.create');

    }
    function store(ColorFormRequest  $request){
        $validateData = $request->validated();

        Color::create([
            'name'=>$validateData['name'],
            'code'=>$validateData['code'],
            'status'=>$request->status == true?'1':'0'
        ]);

        return redirect('admin/colors')->with('message','Color Added successfully');
    }
    function edit($color_id){
        $color = Color::findOrFail($color_id);
        return view('admin.colors.edit',compact('color'));
    }
    function update(ColorFormRequest  $request,int $color_id){
        $validateData = $request->validated();


        $color = Color::findOrFail($color_id);
        if($color){
            $color->update([
                'name'=>$validateData['name'],
                'code'=>$validateData['code'],
                'status'=> $request->status == true ?'1':'0'
            ]);
            return redirect('admin/colors')->with('message','Colors Updated successfully');
        }

    }
    function destroy(int $color_id){
      $color =  Color::find($color_id);
      $color->delete();
      return redirect('admin/colors')->with('message','Color deleted successfully');

    }
}
