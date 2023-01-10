<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishlistShow extends Component
{

    function removeWishListItem(int $wishlistId){
        $wishlist = Wishlist::where('user_id',auth()->user()->id)->where('id',$wishlistId)->delete();
        $this->emit('wishlistAddedUpdated');
        session()->flash('message','Wishlist item removed successfully');
        $this->dispatchBrowserEvent('message',[
            'text'=>'Wishlist item removed successfully',
            'type'=>'success',
            'status'=>200
        ]);

    }

    public function render()
    {
        $wishlists = [];
        if (Auth::check()) {
            $wishlists = Wishlist::where('user_id', auth()->user()->id)->get();
        }

        return view('livewire.frontend.wishlist-show', ['wishlists' => $wishlists]);
    }
}
