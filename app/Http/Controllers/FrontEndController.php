<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class FrontEndController extends Controller
{
    public function homePage(Request $request){
        

        $data = [
            'pageTitle' => 'Sense Party | Loja de Sonhos',
           
        ];
        return view('front.pages.home', $data);

    }

    public function shopPage(Request $request , Product $product){
       

        $produtos  = Product::all();    

        $produtosPaginados = Product::paginate(4);

        $cart = Cart::content();
        

        $data = [
            'pageTitle' => 'Loja',
            
        ];
        return view('front.pages.shop', $data, compact('produtos', 'produtosPaginados','product', 'cart'));
    }


    public function singleProduct(Request $request, $id, Product $product){
      

        $single_produto  = Product::find($id);

        if (!$single_produto) {
            return redirect()->route('shop')->with('error', 'Produto não encontrado.');
        }


        $produtoPagSingle = Product::paginate(4);

        $data = [
          
            'pageTitle' => $single_produto->name,
            'produtoPagSingle' => $produtoPagSingle
        ];

        return view('front.pages.single_product', $data,  compact('single_produto'));
    }

    public function contactPage(Request $request){
      

        $data = [
           
            'pageTitle' => 'Contato'
        ];
        return view('front.pages.contact', $data);
    }
}
