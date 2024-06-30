<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    
    protected function redirectTo($request): ?string
    {
        // Se a requisição espera uma resposta JSON, retorna null
        if ($request->expectsJson()) {
            return null;
        }

        // Se for uma rota de administração
        if ($request->routeIs('admin.*')) {
            session()->flash('fail', 'Você precisa estar logado para acessar esta página');
            return route('admin.auth'); // Redireciona para a página de login do admin
        }

        // Se for uma rota de vendedor
        if ($request->routeIs('seller.*')) {
            session()->flash('fail', 'Você precisa estar logado para acessar esta página');
            return route('seller.auth'); // Redireciona para a página de login do vendedor
        }

        // Caso contrário, redireciona para a página de login padrão
        session()->flash('fail', 'Você precisa estar logado para realizar um pedido');
        return route('seller.auth'); // Redireciona para a página de login do vendedor
    }
}
