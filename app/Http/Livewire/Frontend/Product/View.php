<?php

namespace App\Http\Livewire\Frontend\Product;

use Livewire\Component;

class View extends Component
{
    public $category, $product, $productColorSlectedQuantity;

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
