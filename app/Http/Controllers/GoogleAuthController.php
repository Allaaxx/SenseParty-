<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callBackGoogle()
    {
        try {
            $google_user = Socialite::driver('google')->user();
            $user = Seller::where('google_id', $google_user->getId())->first();

            if (!$user) {
                // Se o usuário do Google não existe, cria um novo
                $new_user = Seller::create([
                    'name' => $google_user->getName(),
                    'username' => $google_user->getName(), // Você pode ajustar conforme necessário
                    'email' => $google_user->getEmail(),
                    'google_id' => $google_user->getId(),
                    'picture' => $this->transformGoogleImageUrl($google_user->getAvatar()),
                    'status' => 'Active'
                ]);

                Auth::guard('seller')->login($new_user);
                return redirect()->intended('/seller');
            } else {
                // Atualiza a imagem do usuário existente se necessário
                $user->update([
                    'picture' => $this->transformGoogleImageUrl($google_user->getAvatar())
                ]);

                Auth::guard('seller')->login($user);
                return redirect()->intended('/seller');
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    protected function transformGoogleImageUrl($url)
    {
        // Função para ajustar o tamanho da imagem do Google
        if (strpos($url, 's96-c') !== false) {
            return str_replace('s96-c', 's150-c', $url);
        } elseif (strpos($url, '=') !== false) {
            return preg_replace('/=[^&]*/', '=s150-c', $url);
        } else {
            return $url . '=s150-c';
        }
    }
}
