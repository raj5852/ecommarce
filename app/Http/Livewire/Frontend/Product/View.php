<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{
    public $category, $product, $productColorSlectedQuantity, $quantityCount = 1, $productColorId;




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


    function addToCard(int $productId)
    {
        if (Auth::check()) {

            if ($this->product->where('id', $productId)->where('status', 0)->exists()) {



                //check for product color quantity and add to cart
                if ($this->product->productColors()->count() > 0) {
                    // dd('product color');

                    if ($this->productColorSlectedQuantity != NULL) {
                        // dd("Color selected");

                        if (Cart::where('user_id', auth()->user()->id)
                            ->where('product_id', $productId)
                            ->where('product_color_id', $this->productColorId)
                            ->exists()
                        ) {
                            $this->dispatchBrowserEvent(
                                'message',
                                [
                                    'text' => 'Product Already Added',
                                    'type' => 'info',
                                    'status' => 401
                                ]
                            );
                            return false;
                        } else {

                            $productColor = $this->product->productColors()->where('id', $this->productColorId)->first();
                            if ($productColor->quantity > 0) {

                                if ($productColor->quantity >= $this->quantityCount) {
                                    //insert product to cart
                                    // dd('add to  cart without colors');
                                    Cart::create([
                                        'user_id' => auth()->user()->id,
                                        'product_id' => $productId,
                                        'product_color_id' => $this->productColorId,
                                        'quantity' => $this->quantityCount,

                                    ]);
                                    $this->emit('CartAddedUpdated');

                                    $this->dispatchBrowserEvent(
                                        'message',
                                        [
                                            'text' => 'Product added to cart',
                                            'type' => 'info',
                                            'status' => 200
                                        ]
                                    );
                                    return false;
                                } else {
                                    //ss
                                    session()->flash('message', 'Only ' . $productColor->quantity . ' quantity Available');
                                    $this->dispatchBrowserEvent(
                                        'message',
                                        [
                                            'text' => 'Only ' . $productColor->quantity. ' quantity Available',
                                            'type' => 'info',
                                            'status' => 401
                                        ]
                                    );
                                    return false;
                                }
                            } else {
                                $this->dispatchBrowserEvent(
                                    'message',
                                    [
                                        'text' => 'Out of Stock',
                                        'type' => 'info',
                                        'status' => 401
                                    ]
                                );
                                return false;
                            }
                        }
                    } else {
                        $this->dispatchBrowserEvent(
                            'message',
                            [
                                'text' => 'Select your product color',
                                'type' => 'info',
                                'status' => 401
                            ]
                        );
                        return false;
                    }
                } else {

                    if (Cart::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()) {
                        $this->dispatchBrowserEvent(
                            'message',
                            [
                                'text' => 'Product Already Added',
                                'type' => 'info',
                                'status' => 401
                            ]
                        );
                        return false;
                    } else {

                        if ($this->product->quantity > 0) {
                            if ($this->product->quantity >= $this->quantityCount) {
                                //insert product to cart
                                // dd('add to  cart without colors');
                                Cart::create([
                                    'user_id' => auth()->user()->id,
                                    'product_id' => $productId,
                                    'quantity' => $this->quantityCount,
                                ]);
                                $this->emit('CartAddedUpdated');

                                $this->dispatchBrowserEvent(
                                    'message',
                                    [
                                        'text' => 'Product added to cart',
                                        'type' => 'info',
                                        'status' => 200
                                    ]
                                );
                                return false;
                            } else {
                                session()->flash('message', 'Only ' . $this->product->quantity . ' quantity Available');
                                $this->dispatchBrowserEvent(
                                    'message',
                                    [
                                        'text' => 'Only ' . $this->product->quantity . ' quantity Available',
                                        'type' => 'info',
                                        'status' => 401
                                    ]
                                );
                                return false;
                            }
                        } else {
                            session()->flash('message', 'Out of Stock');
                            $this->dispatchBrowserEvent(
                                'message',
                                [
                                    'text' => 'Out of Stock',
                                    'type' => 'info',
                                    'status' => 401
                                ]
                            );
                            return false;
                        }
                    }
                }
            } else {
                session()->flash('message', 'Product does not exists');
                $this->dispatchBrowserEvent(
                    'message',
                    [
                        'text' => 'Product does not exists',
                        'type' => 'info',
                        'status' => 401
                    ]
                );
                return false;
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



    function decrementQuantity()
    {
        if ($this->quantityCount > 1) {
            $this->quantityCount--;
        }
    }
    function incrementQuantity()
    {
        $this->quantityCount++;
    }
    function mount($category, $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    function colorSelected($productColorId)
    {
        $this->productColorId = $productColorId;
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
