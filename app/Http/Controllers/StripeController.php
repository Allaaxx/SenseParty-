<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripeController extends Controller
{
    public function session(Request $request)
    {
        $cartCount = session()->has('cart') ? count(session('cart')) : 0;
        // Configura a chave secreta do Stripe
        Stripe::setApiKey(config('stripe.sk'));

        // Monta os itens do carrinho para o checkout
        $productItems = [];
        foreach (session('cart') as $id => $details) {
            $product_name = $details['name'];
            $total = $details['price'] * 100; // Converte para centavos (moeda menor)
            $quantity = $details['quantity'];

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
        $cartCount = session()->has('cart') ? count(session('cart')) : 0;

        $data = [
            'pageTitle' => 'Pedido Concluido',
            'cartCount' => $cartCount,
        ];
        return view('cart.success', $data);
    }

    public function cancel()
    {
        $cartCount = session()->has('cart') ? count(session('cart')) : 0;

        $data = [
            'pageTitle' => 'Pedido Cancelado',
            'cartCount' => $cartCount,
        ];
        return view('cart.cancel', $data);
    }
}
