<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name,$slug,$status,$brand_id;


    function  inputReset(){
        $this->name = NULL;
        $this->slug = NULL;
        $this->status = NULL;
        $this->brand_id = NULL;
    }

    function storeBrand(){
        $validateData = $this->validate();
        Brand::create([
            'name'=>$this->name,
            'slug'=>Str::slug($this->slug),
            'status'=>$this->status == true ?'1':'0'
        ]);
        session()->flash('message','Brand Addedd Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->inputReset();
    }



    function rules(){
        return [
            'name'=>'required|string',
            'slug'=>'required|string',
        ];
    }

    function closeOrOpenModal(){
        $this->inputReset();
    }

    function editBrand($brand_id){
        $this->brand_id = $brand_id;
        $brand = Brand::findOrFail($brand_id);
        $this->name = $brand->name;
        $this->slug = $brand->slug;
        $this->status = $brand->status;
    }
    function updateBrand(){
        $validateData = $this->validate();
        Brand::find($this->brand_id)->update([
            'name'=>$this->name,
            'slug'=>Str::slug($this->slug),
            'status'=>$this->status == true ?'1':'0'
        ]);
        session()->flash('message','Brand Updated Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->inputReset();
    }
    function deleteBrand($brand_id){
        $this->brand_id = $brand_id;

    }
    function destroyBrand(){
        Brand::findOrFail($this->brand_id)->delete();
        session()->flash('message','Brand Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->inputReset();
    }

    public function render()
    {
        $brands = Brand::orderBy('id','DESC')->paginate(10);

        return view('livewire.admin.brand.index',['brands'=>$brands])
        ->extends('layouts.admin')
        ->section('content')
        ;
    }
}
