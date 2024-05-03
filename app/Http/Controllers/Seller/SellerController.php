<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Seller;
use App\Models\VerificationToken;
use Illuminate\Support\Facades\DB;
use constGuards;
use constDefaults;
use Illuminate\Support\Facades\File;
use Mberecall\Kropify\Kropify;
use App\Models\Shop;



class SellerController extends Controller
{
    public function login(Request $request)
    {
        $data = [
            'pageTitle' => 'Login Vendedor'
        ];
        return view('back.pages.seller.auth.login', $data);
    } // end method 

    public function register(Request $request)
    {
        $data = [
            'pageTitle' => 'Registro Vendedor'
        ];
        return view('back.pages.seller.auth.register', $data);
    } // end method

    public function home(Request $request)
    {
        $data = [
            'pageTitle' => 'Dashboard Vendedor'
        ];
        return view('back.pages.seller.home', $data);
    } // end method

    public function createSeller(Request $request)
    {
        //validar formulario de criação de vendedor
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:sellers',
            'password' => 'min:5|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:5',
        ]);
        $seller = new Seller();
        $seller->name = $request->name;
        $seller->email = $request->email;
        $seller->password = Hash::make($request->password);
        $saved = $seller->save();

        if ($saved) {
            //generate verification token
            $token = base64_encode(Str::random(64));

            VerificationToken::create([
                'user_type' => 'seller',
                'email' => $request->email,
                'token' => $token
            ]);

            $actionLink = route('seller.verify', ['token' => $token]);
            $data['action_link'] = $actionLink;
            $data['seller_name'] = $request->name;
            $data['seller_email'] = $request->email;

            //send email activation to seller
            $mail_body = view('email-templates.seller-verify-template', $data)->render();

            $mailConfig = array(
                'mail_from_email' => env('EMAIL_FROM_ADDRESS'),
                'mail_from_name' => env('EMAIL_FROM_NAME'),
                'mail_recipient_email' => $request->email,
                'mail_recipient_name' => $request->name,
                'mail_subject' => 'Verificação de conta de vendedor',
                'mail_body' => $mail_body
            );

            if (sendEmail($mailConfig)) {
                return redirect()->route('seller.register-success')->with('success', 'Conta de vendedor criada com sucesso. Verifique seu email para ativar sua conta');
            } else {
                return redirect()->route('seller.register')->with('fail', 'Erro ao enviar email de verificação');
            }
        } else {
            return redirect()->route('seller.register')->with('fail', 'Erro ao criar conta de vendedor');
        }
    } //eND Method

    public function verifyAccount(Request $request, $token)
    {
        $verifyToken = VerificationToken::where('token', $token)->first();

        if (!is_null($verifyToken)) {
            $seller = Seller::where('email', $verifyToken->email)->first();

            if (!$seller->verified) {
                $seller->verified = 1;
                $seller->email_verified_at = Carbon::now();
                $seller->save();

                return redirect()->route('seller.login')->with('success', 'Conta de vendedor verificada com sucesso. você pode fazer login.');
            } else {
                return redirect()->route('seller.login')->with('info', 'Conta de vendedor já verificada. você pode fazer login.');
            }
        } else {
            return redirect()->route('seller.register')->with('fail', 'Token de verificação inválido');
        }
    } // end method

    public function registerSuccess(Request $request)
    {
        $data = [
            'pageTitle' => 'Registro completado'
        ];
        return view('back.pages.seller.register-success', $data);
    } // end method

    public function loginHandler(Request $request)
    {
        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if ($fieldType == 'email') {
            $request->validate([
                'login_id' => 'required|email|exists:sellers,email',
                'password' => 'required|min:5|max:45'
            ], [
                'login_id.required' => 'E-mail ou nome de usuário é obrigatório',
                'login_id.email' => 'E-mail inválido',
                'login_id.exists' => 'E-mail não encontrado',
                'password.required' => 'Senha é obrigatória',
            ]);
        } else {
            $request->validate([
                'login_id' => 'required|exists:sellers,username',
                'password' => 'required|min:5|max:45'
            ], [
                'login_id.required' => 'E-mail ou nome de usuário é obrigatório',
                'login_id.exists' => 'E-mail não encontrado',
                'password.required' => 'Senha é obrigatória',
            ]);
        }

        $creds = array(
            $fieldType => $request->login_id,
            'password' => $request->password
        );

        if (Auth::guard('seller')->attempt($creds)) {
            // return redirect()->route('seller.home');
            if (!auth('seller')->user()->verified) {
                Auth::guard('seller')->logout();
                return redirect()->route('seller.login')->with('fail', 'Sua conta não está verificada. Verifique seu email');
            } else {
                return redirect()->route('seller.home');
            }
        } else {
            return redirect()->route('seller.login')->with('fail', 'Credenciais inválidas');
        }
    } //End method

    public function logoutHandler(Request $request)
    {
        Auth::guard('seller')->logout();
        return redirect()->route('seller.login')->with('fail', 'Você saiu !');
    } // end method

    public function forgotPassword(Request $request)
    {
        $data = [
            'pageTitle' => 'Esqueceu a senha'
        ];
        return view('back.pages.seller.auth.forgot', $data);
    } //end method

    public function sendResetPasswordLink(Request $request)
    {
        //validate the form
        $request->validate([
            'email' => 'required|email|exists:sellers,email'
        ], [
            'email.required' => 'E-mail é obrigatório',
            'email.email' => 'E-mail inválido',
            'email.exists' => 'E-mail não encontrado'
        ]);

        //get seller details
        $seller = Seller::where('email', $request->email)->first();

        //generate reset token
        $token = base64_encode(Str::random(64));

        //check if there is an exisiting token reset password
        $oldToken = DB::table('password_reset_tokens')
            ->where(['email' => $seller->email, 'guard' => constGuards::SELLER])
            ->first();
        if ($oldToken) {
            // update existing token
            DB::table('password_reset_tokens')
                ->where(['email' => $seller->email, 'guard' => constGuards::SELLER])
                ->update([
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]);
        } else {
            //create new token
            DB::table('password_reset_tokens')
                ->insert([
                    'email' => $seller->email,
                    'token' => $token,
                    'guard' => constGuards::SELLER,
                    'created_at' => Carbon::now()
                ]);
        }

        $actionLink = route('seller.reset-password', ['token' => $token, 'email' => urlencode($seller->email)]);

        $data['action_link'] = $actionLink;
        $data['seller'] = $seller;
        $mail_body = view('email-templates.seller-forgot-email-template', $data)->render();

        $mailConfig = array(
            'mail_from_email' => env('EMAIL_FROM_ADDRESS'),
            'mail_from_name' => env('EMAIL_FROM_NAME'),
            'mail_recipient_email' => $seller->email,
            'mail_recipient_name' => $seller->name,
            'mail_subject' => 'Redefinir senha',
            'mail_body' => $mail_body
        );

        if (sendEmail($mailConfig)) {
            return redirect()->route('seller.forgot-password')->with('success', 'Link de redefinição de senha enviado para seu e-mail');
        } else {
            return redirect()->route('seller.forgot-password')->with('fail', 'Erro ao enviar link de redefinição de senha');
        }
    } //end method

    public function showResetForm(Request $request, $token = null)
    {
        // check if token is valid
        $get_token = DB::table('password_reset_tokens')
            ->where(['token' => $token, 'guard' => constGuards::SELLER])
            ->first();

        if ($get_token) {
            // check if token is expired
            $diffMins = Carbon::createFromFormat('Y-m-d H:i:s', $get_token->created_at)
                ->diffInMinutes(Carbon::now());

            if ($diffMins > constDefaults::tokenExpiredMinutes) {
                // when token is older than 15minutes
                return redirect()->route('seller.forgot-password', ['token' => $token])->with('fail', 'Token de redefinição de senha expirado');
            } else {
                return view('back.pages.seller.auth.reset')->with(['token' => $token]);
            }
        } else {
            return redirect()->route('seller.forgot-password', ['token' => $token])->with('fail', 'Token de redefinição de senha inválido');
        }
    } //end method

    public function resetPasswordHandler(Request $request)
    {
        //validate the form
        $request->validate([
            'new_password' => 'required|min:5|max:45|required_with:confirm_new_password|same:confirm_new_password',
            'confirm_new_password' => 'required'
        ]);

        $token = DB::table('password_reset_tokens')
            ->where(['token' => $request->token, 'guard' => constGuards::SELLER])
            ->first();

        //GET SELLER DETAILS
        $seller = Seller::where('email', $token->email)->first();

        //update seller password
        Seller::where('email', $seller->email)->update([
            'password' => Hash::make($request->new_password)
        ]);

        //delete token
        DB::table('password_reset_tokens')->where([
            'email' => $seller->email,
            'token' => $request->token,
            'guard' => constGuards::SELLER
        ])->delete();


        //send email notification

        $data['seller'] = $seller;
        $data['new_password'] = $request->new_password;
        $mail_body = view('email-templates.seller-reset-email-template', $data);

        $mailConfig = array(
            'mail_from_email' => env('EMAIL_FROM_ADDRESS'),
            'mail_from_name' => env('EMAIL_FROM_NAME'),
            'mail_recipient_email' => $seller->email,
            'mail_recipient_name' => $seller->name,
            'mail_subject' => 'Senha redefinida',
            'mail_body' => $mail_body
        );

        sendEmail($mailConfig);
        return redirect()->route('seller.login')->with('success', 'Senha redefinida com sucesso. Faça login com sua nova senha');
    } //end method

    public function profileView(Request $request)
    {
        $data = [
            'pageTitle' => 'Perfil do vendedor'
        ];
        return view('back.pages.seller.profile', $data);
    }

    public function changeProfilePicture(Request $request)
    {
        $seller = Seller::findOrFail(auth('seller')->id());
        $path = 'images/users/sellers/';
        $file = $request->file('sellerProfilePictureFile');
        $old_picture = $seller->picture;
        $filename = 'SELLER_IMG_' . $seller->id . '.jpg';

        $upload = Kropify::getFile($file, $filename)->maxWoH(325)->save($path);
        $infos = $upload->getInfo();
        if ($upload) {
            if ($old_picture != null) {
                $oldPicturePath = parse_url($old_picture, PHP_URL_PATH);
                $oldPicturePath = str_replace('/images/users/sellers/', '', $oldPicturePath);
                if (File::exists(public_path('images/users/sellers/' . $oldPicturePath))) {
                    File::delete(public_path('images/users/sellers/' . $oldPicturePath));
                }
            }

            $seller->update(['picture' => $infos->getName]);

            return response()->json(['status' => 1, 'msg' => 'Imagem de perfil atualizada com sucesso']);
        } else {
            return response()->json(['status' => 0, 'msg' => 'Erro ao fazer upload da imagem']);
        }
    }


    public function shopSettings(Request $request)
    {
        $seller = Seller::findOrFail(auth('seller')->id());
        $shop = Shop::where('seller_id', $seller->id)->first();
        $shopInfo = '';

        if (!$shop) {
            //create a  shop for this seller where not exists
            Shop::create(['seller_id' => $seller->id]);
            $nshop = Shop::where('seller_id', $seller->id)->first();
            $shopInfo = $nshop;
        } else {
            $shopInfo = $shop;
        }

        $data = [
            'pageTitle' => 'Configurações da loja',
            'shopInfo' => $shopInfo
        ];

        return view('back.pages.seller.shop-settings', $data);
    }

    public function shopSetup(Request $request)
    {
        $seller = Seller::findOrFail(auth('seller')->id());
        $shop = Shop::where('seller_id', $seller->id)->first();
        $old_logo_name = $shop->shop_logo;
        $logo_name = '';
        $path = 'images/shop/';

        //validate the form
        $request->validate([
            'shop_name' => 'required|unique:shops,shop_name,' . $shop->id,
            'shop_phone' => 'required|numeric',
            'shop_address' => 'required',
            'shop_description' => 'required',
            'shop_logo' => 'nullable|mimes:jpg,jpeg,png'
        ]);

        if ($request->hasFile('shop_logo')) {
            $file = $request->file('shop_logo');
            $filename = 'SHOP_LOGO_' . $seller->id . uniqid() . '.' .
                $file->getClientOriginalExtension();

            $upload = $file->move(public_path($path), $filename);

            if ($upload) {
                $logo_name = $filename;

                //Delete an existing shop logo
                if ($old_logo_name != null && File::exists(public_path($path . $old_logo_name))) {
                    File::delete(public_path($path . $old_logo_name));
                }
            }
        }

        //update seller shop info
        $data = array(
            'shop_name' => $request->shop_name,
            'shop_phone' => $request->shop_phone,
            'shop_address' => $request->shop_address,
            'shop_description' => $request->shop_description,
            'shop_logo' => $logo_name != null ? $logo_name : $old_logo_name
        );

        $update = $shop->update($data);

        if ($update) {
            return redirect()->route('seller.shop-settings')->with('success', 'Configurações da loja atualizadas com sucesso');
        } else {
            return redirect()->route('seller.shop-settings')->with('fail', 'Erro ao atualizar configurações da loja');
        }
    }
}
