<?php


use Livewire\Component;
use App\Models\Product;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;

class produtossos extends Component{

    public $produtossos;

    public function mount()
    {
        $this->produtossos = Product::all();
        $cart = Cart::content();
        dd($cart);
    }

    public function render()
    {
        return view('livewire.product-lists');
    }
}
