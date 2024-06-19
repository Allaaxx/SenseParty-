<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Exception\ApiErrorException;

class CartController extends Controller
{
    public function addToCart(Request $request)
{
    $product = Product::find($request->product_id);
    $cart = session()->get('cart', []);

    if (isset($cart[$product->id])) {
        // Se o produto já existe no carrinho, atualize a quantidade
        $cart[$product->id]['quantity'] += $request->quantity;
    } else {
        // Se o produto não existe no carrinho, adicione-o
        $cart[$product->id] = [
            "name" => $product->name,
            "quantity" => $request->quantity,
            "price" => $product->price,
        ];
    }

    session()->put('cart', $cart);

    // Retorne uma resposta JSON indicando sucesso
    return response()->json([
        'success' => true,
        'message' => 'Produto adicionado ao carrinho com sucesso.'
    ]);
}

public function index()
{
    $cart = session()->get('cart', []);
    $cartCount = count($cart); 

    return view('cart.index', compact('cart', 'cartCount'));
}


    public function checkout(Request $request)
    {
        // Verificar se há itens no carrinho
        $cart = session()->get('cart');
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty. Please add some items before checkout.');
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $line_items = array_map(function($item) {
            return [
                'price_data' => [
                    'currency' => 'BRL', // ou 'BRL' para moeda brasileira
                    'product_data' => [
                        'name' => $item['name'],
                    ],
                    'unit_amount' => $item['price'] * 100,
                ],
                'quantity' => $item['quantity'],
            ];
        }, $cart);

        try {
            $session = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items' => $line_items,
                'mode' => 'payment',
                'success_url' => route('success'),
                'cancel_url' => route('cancel'),
            ]);

            return redirect($session->url);
        } catch (ApiErrorException $e) {
            return redirect()->back()->with('error', 'Failed to initiate checkout. Please try again later.');
        }
    }

    public function success()
    {
        session()->forget('cart');
        return view('cart.success');
    }

    public function cancel()
    {
        return view('cart.cancel');
    }

    public function removeFromCart(Request $request)
{
    $productId = $request->product_id;

    $cart = session()->get('cart', []);

    if (isset($cart[$productId])) {
        unset($cart[$productId]);
        session()->put('cart', $cart);
        return response()->json([
            'success' => true,
            'message' => 'Produto removido do carrinho com sucesso.'
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'Produto não encontrado no carrinho.'
    ]);
}



    
}
