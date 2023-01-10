<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{
    public $category, $product, $productColorSlectedQuantity;

    function addToWishList($productId)
    {
        // dd($productId);
        if (Auth::check()) {
            if (Wishlist::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()) {
                session()->flash('message', 'Already to Wishlist');
                $this->dispatchBrowserEvent(
                    'message',
                    [
                        'text' => 'Already to Wishlist',
                        'type' => 'info',
                        'status' => 409
                    ]
                );
                return false;
            } else {
                $widhlist = Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId
                ]);
                $this->emit('wishlistAddedUpdated');
                session()->flash('message', 'Wishlist Added Successfully');
                $this->dispatchBrowserEvent(
                    'message',
                    [
                        'text' => 'Wishlist Added Successfully',
                        'type' => 'info',
                        'status' => 200
                    ]
                );
            }
        } else {
            session()->flash('message', 'Please  Login to Continu');
            $this->dispatchBrowserEvent(
                'message',
                [
                    'text' => 'Please  Login to Continu',
                    'type' => 'info',
                    'status' => 401
                ]
            );
            return false;
        }
    }
    function mount($category, $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    function colorSelected($productColorId)
    {
        $productColor =  $this->product->productColors()->where('id', $productColorId)->first();

        $this->productColorSlectedQuantity =  $productColor->quantity;

        if ($this->productColorSlectedQuantity == 0) {
            $this->productColorSlectedQuantity = "outOfStock";
        }
    }


    public function render()
    {
        return view('livewire.frontend.product.view', [
            'category' => $this->category,
            'product' => $this->product,
        ]);
    }
}
