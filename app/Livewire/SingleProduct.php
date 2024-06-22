<?php

namespace App\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class SingleProduct extends Component
{
    public $single_produto;
    public $produtos;
    public array $quantity = [];

    public function mount($id)
    {
        $this->single_produto = Product::findOrFail($id);
        $this->produtos = Product::all();
        foreach ($this->produtos as $produto) {
            $this->quantity[$produto->id] = 1;
        }
    }

    public function addToCart()
    {
        Cart::add([
            'id' => $this->single_produto->id,
            'name' => $this->single_produto->name,
            'qty' => $this->quantity[$this->single_produto->id],
            'price' => $this->single_produto->price,
        ]);

        $this->dispatch('cart_updated');

        return response()->json([
            'success' => true,
            'message' => 'Produto adicionado ao carrinho com sucesso!',
        ]);
        
    }

    public function render()
    {
        return view('livewire.single-product');
    }
}
