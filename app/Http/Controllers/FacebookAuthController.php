<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callBackFacebook()
    {
        try {
            $facebook_user = Socialite::driver('facebook')->user();
            $user = Seller::where('facebook_id', $facebook_user->getId())->first();

            if (!$user) {
                $new_user = Seller::create([
                    'name' => $facebook_user->getName(),
                    'username' => $facebook_user->getName(),
                    'email' => $facebook_user->getEmail(),
                    'facebook_id' => $facebook_user->getId(),
                    'picture' => $facebook_user->getAvatar(),
                    'status' => 'Active'
                ]);

                Auth::guard('seller')->login($new_user);
                return redirect()->intended('/seller');
            } else {
                $user->update([
                    'picture' => $facebook_user->getAvatar()
                ]);

                Auth::guard('seller')->login($user);
                return redirect()->intended('/seller');
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
