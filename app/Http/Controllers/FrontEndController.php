<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function homePage(Request $request){
        $data = [
            'pageTitle' => 'Sense Party | Loja de Sonhos'
        ];
        return view('front.pages.home', $data);

    }
}
