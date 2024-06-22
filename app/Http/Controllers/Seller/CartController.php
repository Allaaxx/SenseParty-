<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{

    public function addToCart(Request $request){
        return response()->json([
            'success' => true,
            'message' => 'Produto adicionado ao carrinho com sucesso!',
        ]);
    }

    public function removeFromCart(Request $request){
        return response()->json([
            'success' => true,
            'message' => 'Produto removido do carrinho com sucesso!',
        ]);
    }

    public function index()
    {
        // Recupera os itens do carrinho
        $cartItems = Cart::content();

        // Inicializa um array para armazenar os produtos associados
        $products = [];

        // Para cada item do carrinho, adiciona o modelo Product associado ao array de produtos
        foreach ($cartItems as $cartItem) {
            // Recupera o modelo Product associado ao item do carrinho
            $product = Product::find($cartItem->id); // Aqui assumindo que o id do produto está no campo id do carrinho

            // Verifica se o produto foi encontrado antes de adicioná-lo ao array
            if ($product) {
                $products[$cartItem->id] = $product;
            }
        }

        // Passa os dados para a view cart.index
        return view('cart.index', compact('cartItems', 'products'));
    }
}
