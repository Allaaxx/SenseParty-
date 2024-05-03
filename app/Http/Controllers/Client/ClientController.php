<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function loginRegister(Request $request){
        $data = [
            'pageTitle' => 'Sense Party | Login e Registro',
        ];
        return view('back.pages.client.auth.login-register', $data);
    }

    public function home(Request $request){
        $data = [
            'pageTitle' => 'Sense Party | Loja de Sonhos'
        ];
        return view('back.pages.client.home', $data);

    }

}
