<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderFormRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index', compact('sliders'));
    }
    function create()
    {
        return view('admin.slider.create');
    }
    function store(SliderFormRequest $request)
    {
        $validateData = $request->validated();
        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/slider/', $filename);
            $validateData['image'] = 'uploads/slider/' . $filename;
        }

        Slider::create([
            'title' => $validateData['title'],
            'description' => $validateData['description'],
            'image' => $validateData['image'],
            'status' => $request->status == true ? '1' : '0',
        ]);

        return redirect('admin/sliders')->with('message', 'Slider Added Successfully');
    }
    function edit(Slider $slider)
    {
        return view('admin.slider.edit', compact('slider'));
    }
    function update(SliderFormRequest $request, int $slider_id)
    {

        $slider = Slider::find($slider_id);
        $validateData = $request->validated();
        if ($request->hasFile('image')) {
            if(File::exists($slider->image)){
                File::delete($slider->image);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/slider/', $filename);
            $validateData['image'] = 'uploads/slider/' . $filename;
        }

        $slider->update([
            'title' => $validateData['title'],
            'description' => $validateData['description'],
            'image' => $validateData['image'] ?? $slider->image,
            'status' => $request->status == true ? '1' : '0',
        ]);

        return redirect('admin/sliders')->with('message', 'Slider Updated Successfully');

    }
    function delete(Slider $slider){
        if(File::exists($slider->image)){
            File::delete($slider->image);
        }
        $slider->delete();
        return redirect('admin/sliders')->with('message', 'Slider Deleted Successfully');
    }
}
