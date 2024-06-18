<?php

use Livewire\Component;
use App\Models\Product;

class ProductDetails extends Component
{
    public $produto;

    public function mount($productId)
    {
        $this->produto = Product::findOrFail($productId);
    }

    public function render()
    {
        return view('livewire.product-details');
    }
}
