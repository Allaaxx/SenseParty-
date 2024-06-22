<?php

namespace App\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class ProductsTable extends Component
{
    
    public function removeFromCart($rowId)
    {
       Cart::remove($rowId);

       // Atualizar a tabela de produtos após a remoção
       $this->dispatch('cart_updated');

       
    }

    public function render()
    {
        // Recupera todos os produtos do banco de dados
        $produtos = Product::all();

        // Recupera os itens do carrinho utilizando o pacote Gloudemans Shoppingcart
        $cartItems = Cart::content();

        // Retorna a view livewire.products-table com os dados
        return view('livewire.products-table', compact('cartItems', 'produtos'));
    }


    
}