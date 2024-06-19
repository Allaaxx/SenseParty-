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
