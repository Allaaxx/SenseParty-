<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class FrontEndController extends Controller
{
    public function homePage(Request $request)
    {


        $data = [
            'pageTitle' => 'Sense Party | Loja de Sonhos',

        ];
        return view('front.pages.home', $data);
    }

    public function shopPage(Request $request, Product $product)
    {


        $produtos  = Product::all();

        $produtosPaginados = Product::paginate(4);

        $cart = Cart::content();


        $data = [
            'pageTitle' => 'Loja',

        ];
        return view('front.pages.shop', $data, compact('produtos', 'produtosPaginados', 'product', 'cart'));
    }


    public function singleProduct(Request $request, $id)
    {
        // Busca o produto pelo ID
        $single_produto = Product::find($id);

        // Verifica se o produto foi encontrado
        if (!$single_produto) {
            return redirect()->route('shop')->with('error', 'Produto não encontrado.');
        }

        // Busca produtos para paginação (exemplo com paginate, ajuste conforme necessário)
        $produtoPagSingle = Product::paginate(4);

        // Dados a serem passados para a view
        $data = [
            'pageTitle' => $single_produto->name,
            'produtoPagSingle' => $produtoPagSingle,
            'single_produto' => $single_produto // Passa o $single_produto para a view
        ];

        // Retorna a view com os dados
        return view('front.pages.single_product', $data);
    }

    public function contactPage(Request $request)
    {


        $data = [

            'pageTitle' => 'Contato'
        ];
        return view('front.pages.contact', $data);
    }
}
