<?php

namespace App\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartTotals extends Component
{

    protected $listeners = ['cart_updated' => 'render'];

    public function render()
    {
        // Recupera os itens do carrinho utilizando o pacote Gloudemans Shoppingcart
        $cartItems = Cart::content();

        $subtotal = 0; // Inicializa a variável $subtotal
        $shippingCost = 45; // Custo fixo do frete

        foreach ($cartItems as $cartItem) {
            // Calcula o subtotal de cada item (preço * quantidade)
            $itemTotal = $cartItem->price * $cartItem->qty;
            $subtotal += $itemTotal;
        }

        return view('livewire.cart-totals', [
            'subtotal' => $subtotal,
            'shippingCost' => $shippingCost,
            'cartItems' => $cartItems,
        ]);
    }
}
