<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function homePage(Request $request){
        $cartCount = session()->has('cart') ? count(session('cart')) : 0;

        $data = [
            'pageTitle' => 'Sense Party | Loja de Sonhos',
            'cartCount' => $cartCount,
        ];
        return view('front.pages.home', $data);

    }

    public function shopPage(Request $request , Product $product){
        $cartCount = session()->has('cart') ? count(session('cart')) : 0;

        $produtos  = Product::all();    

        $produtosPaginados = Product::paginate(4);

        $data = [
            'pageTitle' => 'Loja',
            'cartCount' => $cartCount,
        ];
        return view('front.pages.shop', $data, compact('produtos', 'produtosPaginados','product'));
    }


    public function singleProduct(Request $request, $id, Product $product){
        $cartCount = session()->has('cart') ? count(session('cart')) : 0;

        $single_produto  = Product::find($id);

        if (!$single_produto) {
            return redirect()->route('shop')->with('error', 'Produto não encontrado.');
        }


        $produtoPagSingle = Product::paginate(4);

        $data = [
            'cartCount' => $cartCount,
            'pageTitle' => $single_produto->name,
            'produtoPagSingle' => $produtoPagSingle
        ];

        return view('front.pages.single_product', $data,  compact('single_produto'));
    }

    public function contactPage(Request $request){
        $cartCount = session()->has('cart') ? count(session('cart')) : 0;

        $data = [
            'cartCount' => $cartCount,
            'pageTitle' => 'Contato'
        ];
        return view('front.pages.contact', $data);
    }
}
