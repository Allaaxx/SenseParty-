<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }

    public function callBackGoogle(){

        try {
            $google_user = Socialite::driver('google')->user();
            
            $user = Seller::where('google_id', $google_user->getId())->first();

            if(!$user){
                $new_user = Seller::create([
                    'name' => $google_user->getName(),
                    'username' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    
                    'google_id' => $google_user->getId(),
                    'picture' => $google_user->getAvatar(),
                    'status' => 'Active'

                ]);

                Auth::guard('seller')->login($new_user);

                return redirect()->intended('/dashboard');

            }
            else{
                Auth::guard('seller')->login($user);

                return redirect()->intended('/dashboard');
            }

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
