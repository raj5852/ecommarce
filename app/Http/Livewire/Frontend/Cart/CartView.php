<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;

class CartView extends Component
{
    public $cart, $totalPrice=0;
    function removeCartItem(int $cartId)
    {
        $cartRemove = Cart::where('id', $cartId)->where('user_id', auth()->user()->id)->first();
        if ($cartRemove) {
            $cartRemove->delete();

            $this->emit('CartAddedUpdated');
            $this->dispatchBrowserEvent(
                'message',
                [
                    'text' => 'Cart item removed successfully',
                    'type' => 'info',
                    'status' => 401
                ]
            );
            return false;
        }else{

            $this->dispatchBrowserEvent(
                'message',
                [
                    'text' => 'Something went wrong',
                    'type' => 'info',
                    'status' => 401
                ]
            );
            return false;
        }
    }
    public  function decrementQuantity(int $cartId)
    {
        $cartData = Cart::where('id', $cartId)->where('user_id', auth()->user()->id)->first();
        if ($cartData) {

            if ($cartData->productColor()->where('id', $cartData->product_color_id)->exists()) {
                // dd('have');
                $productColor = $cartData->productColor()->where('id', $cartData->product_color_id)->first();
                if ($productColor->quantity >= $cartData->quantity) {

                    if ($cartData->quantity  > 1) {
                        $cartData->decrement('quantity');
                    } else {
                        return false;
                    }

                    $this->dispatchBrowserEvent(
                        'message',
                        [
                            'text' => 'Quantity Updated',
                            'type' => 'success',
                            'status' => 200
                        ]
                    );
                } else {

                    $this->dispatchBrowserEvent(
                        'message',
                        [
                            'text' => 'only' . $productColor->quantity . 'Quantity Available',
                            'type' => 'success',
                            'status' => 200
                        ]
                    );
                }
            } else {
                if ($cartData->product->quantity > $cartData->cartData) {

                    if ($cartData->quantity  > 1) {
                        $cartData->decrement('quantity');
                    } else {
                        return false;
                    }

                    $this->dispatchBrowserEvent(
                        'message',
                        [
                            'text' => 'Quantity Updated',
                            'type' => 'success',
                            'status' => 200
                        ]
                    );
                } else {
                    $this->dispatchBrowserEvent(
                        'message',
                        [
                            'text' => 'only' . $cartData->product->quantity . 'Quantity Available',
                            'type' => 'success',
                            'status' => 200
                        ]
                    );
                }
            }

            //  else{

            //     }
        } else {
            $this->dispatchBrowserEvent(
                'message',
                [
                    'text' => 'Something Went Wrong!',
                    'type' => 'error',
                    'status' => 404
                ]
            );
        }
    }

    function incrementQuantity(int $cartId)
    {
        $cartData = Cart::where('id', $cartId)->where('user_id', auth()->user()->id)->first();

        // dd($cartData);
        if ($cartData) {

            if ($cartData->productColor()->where('id', $cartData->product_color_id)->exists()) {
                $productColor = $cartData->productColor()->where('id', $cartData->product_color_id)->first();

                if ($productColor->quantity > $cartData->quantity) {


                    $cartData->increment('quantity');

                    $this->dispatchBrowserEvent(
                        'message',
                        [
                            'text' => 'Quantity Updated',
                            'type' => 'success',
                            'status' => 200
                        ]
                    );
                } else {

                    $this->dispatchBrowserEvent(
                        'message',
                        [
                            'text' => 'only' . $productColor->quantity . 'Quantity Available',
                            'type' => 'success',
                            'status' => 200
                        ]
                    );
                }
            } else {
                if ($cartData->product->quantity > $cartData->cartData) {
                    $cartData->increment('quantity');
                    $this->dispatchBrowserEvent(
                        'message',
                        [
                            'text' => 'Quantity Updated',
                            'type' => 'success',
                            'status' => 200
                        ]
                    );
                } else {
                    $this->dispatchBrowserEvent(
                        'message',
                        [
                            'text' => 'only' . $cartData->product->quantity . 'Quantity Available',
                            'type' => 'success',
                            'status' => 200
                        ]
                    );
                }
            }

            //  else{

            //     }
        } else {
            $this->dispatchBrowserEvent(
                'message',
                [
                    'text' => 'Something Went Wrong!',
                    'type' => 'error',
                    'status' => 404
                ]
            );
        }
    }

    public function render()
    {
        $this->cart = Cart::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.cart.cart-view', [
            'carts' => $this->cart
        ]);
    }
}
