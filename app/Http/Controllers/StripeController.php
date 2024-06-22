<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class StripeController extends Controller
{
    public function session(Request $request)
    {
        // Configura a chave secreta do Stripe
        Stripe::setApiKey(config('stripe.sk'));

        // Monta os itens do carrinho para o checkout
        $productItems = [];
        foreach (Cart::content() as $cartItem) {
            $product_name = $cartItem->name;
            $total = $cartItem->price * 100; // Converte para centavos (moeda menor)
            $quantity = $cartItem->qty;

            $productItems[] = [
                'price_data' => [
                    'product_data' => [
                        'name' => $product_name,
                    ],
                    'currency' => 'BRL',
                    'unit_amount' => $total,
                ],
                'quantity' => $quantity,
            ];
        }

        // Cria a sessão de checkout no Stripe
        $checkoutSession = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $productItems,
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('cancel'),
        ]);

        // Redireciona para a URL de checkout criada pelo Stripe
        return redirect()->away($checkoutSession->url);
    }

    public function success()
    {
        // Limpa o carrinho após o sucesso do pedido
        Cart::destroy();

        $data = [
            'pageTitle' => 'Pedido Concluído',
            'cartCount' => Cart::count(), // Atualiza o contador de itens no carrinho
        ];

        return view('cart.success', $data);
    }

    public function cancel()
    {
        $data = [
            'pageTitle' => 'Pedido Cancelado',
            'cartCount' => Cart::count(), // Atualiza o contador de itens no carrinho
        ];

        return view('cart.cancel', $data);
    }
}
