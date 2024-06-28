<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

class pesquisaProdController extends Controller
{
    public function pesquisa(Request $request)
    {
           if($request->pesquisinha != 1){
             $pesquisaResultados = Product::query()
            
             ->where('name', 'LIKE', '%'.$request->pesquisinha.'%')
             ->orWhere('price', 'LIKE', '%'.$request->pesquisinha.'%')
             ->get();
                   return view('front.pages.search',compact('pesquisaResultados'));
           }else{
                return view('front.pages.search-error',compact('pesquisaResultados'));
           }
    }
}
