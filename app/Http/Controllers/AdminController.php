<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Models\Admin; // Importe a classe Admin aqui
use constGuards;
use constDefaults;

class AdminController extends Controller
{
    public function loginHandler(Request $request)
    {
        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $request->validate([
            'login_id' => 'required',
            'password' => 'required',
        ], [
            'login_id.required' => 'O email ou usuário é obrigatório.',
            'password.required' => 'A senha é obrigatória.',
        ]);

        if ($fieldType == 'email') {
            $request->validate([
                'login_id' => 'email|exists:admins,email',
            ], [
                'login_id.email' => 'O email deve ser válido.',
                'login_id.exists' => 'O email não existe.',
            ]);
        } else {
            $request->validate([
                'login_id' => 'exists:admins,username',
            ], [
                'login_id.exists' => 'O usuário não existe.',
            ]);
        }

        $creds = [
            $fieldType => $request->login_id,
            'password' => $request->password,
        ];

        if (Auth::guard('admin')->attempt($creds)) {
            return redirect()->route('admin.home');
        } else {
            return redirect()->route('admin.login')->with('fail', 'Credenciais inválidas.');
        }
    }

    public function logoutHandler(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Você saiu com sucesso.');
    }

    public function sendPasswordResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins,email',
        ], [
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'Forneça um email válido.',
            'email.exists' => 'O email não existe.',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        $token = base64_encode(Str::random(64));

        $oldToken = DB::table('password_reset_tokens')
                        ->where(['email' => $request->email, 'guard' => constGuards::ADMIN])
                        ->first();

        if ($oldToken) {
            DB::table('password_reset_tokens')
                ->where(['email' => $request->email, 'guard' => constGuards::ADMIN])
                ->update([
                    'token' => $token, 
                    'created_at' => Carbon::now()
                ]);
        } else {
            DB::table('password_reset_tokens')
                ->insert([
                    'email' => $request->email,
                    'guard' => constGuards::ADMIN,
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]);
        }

        $actionLink = route('admin.reset-password', ['token' => $token]);

        $data = [
            'actionLink' => $actionLink,
            'admin' => $admin
        ];

        $mail_body = view('email-templates.admin-forgot-email-template', $data)->render();

        $mailConfig = [
            'mail_from_email' => env('EMAIL_FROM_ADDRESS'),
            'mail_from_name' => env('EMAIL_FROM_NAME'),
            'mail_recipient_email' => $admin->email,
            'mail_recipient_name' => $admin->name,
            'mail_subject' => 'Redefinir Senha',
            'mail_body' => $mail_body
        ];

        if (sendEmail($mailConfig)) {
            return redirect()->route('admin.forgot-password')->with('success', 'Um link para redefinir a senha foi enviado para o seu email.');
        } else {
            return redirect()->route('admin.forgot-password')->with('fail', 'Algo deu errado. Tente novamente.');
        }
    }

    public function resetPassword(Request $request, $token = null)
    {
        $check_token = DB::table('password_reset_tokens')
                        ->where(['token' => $token, 'guard' => constGuards::ADMIN])
                        ->first();

        if ($check_token) {
            $diffMins = Carbon::createFromFormat('Y-m-d H:i:s', $check_token->created_at)->diffInMinutes(Carbon::now());

            if ($diffMins > constDefaults::tokenExpiredMinutes) {
                return redirect()->route('admin.forgot-password', ['token' => $token])->with('fail', 'O token expirou. Por favor, tente novamente.');
            } else {
                return view('back.pages.admin.auth.reset-password')->with(['token' => $token]);
            }
        } else {
            return redirect()->route('admin.forgot-password', ['token' => $token])->with('fail', 'Token inválido. Por favor, tente novamente.');
        }
    }

    public function resetPasswordHandler(Request $request)
    {
        $request->validate([
            'new_password' => 'required|min:5|max:45|required_with:new_password_confirmation|same:new_password_confirmation',
            'new_password_confirmation' => 'required|same:new_password',
        ], [
            'new_password.required' => 'O campo Nova Senha é obrigatório.',
            'new_password.min' => 'A nova senha deve ter no mínimo :min caracteres.',
            'new_password.max' => 'A nova senha deve ter no máximo :max caracteres.',
            'new_password_confirmation.required' => 'O campo Confirmação de Nova Senha é obrigatório.',
            'new_password_confirmation.same' => 'As senhas digitadas nos campos Nova Senha e Confirmação de Nova Senha devem ser iguais.',
            'new_password.same' => ''
        ]);
        

        $token = DB::table('password_reset_tokens')
                    ->where(['token' => $request->token, 'guard' => constGuards::ADMIN])
                    ->first();
        
        $admin = Admin::where('email', $token->email)->first();

        Admin::where('email', $admin->email)->update([
            'password' => Hash::make($request->new_password)
        ]);

        DB::table('password_reset_tokens')
            ->where([
                'email' => $admin->email,
                'token' => $request->token, 
                'guard' => constGuards::ADMIN
            ])->delete();

        $data = [
            'admin' => $admin,
            'new_password' => $request->new_password,
        ];
        
        $mail_body = view('email-templates.admin-reset-email-template', $data)->render();

        $mailConfig = [
            'mail_from_email' => env('EMAIL_FROM_ADDRESS'),
            'mail_from_name' => env('EMAIL_FROM_NAME'),
            'mail_recipient_email' => $admin->email,
            'mail_recipient_name' => $admin->name,
            'mail_subject' => 'Senha Redefinida com Sucesso',
            'mail_body' => $mail_body
        ];

        sendEmail($mailConfig);

        return redirect()->route('admin.login')->with('success', 'Senha redefinida com sucesso.');
    }
    
    public function profileView(Request $request){
        $admin = null;
        if(Auth::guard('admin')->check()){
            $admin = Admin::findOrFail(auth()->id()); // Usando o método user() para obter o usuário autenticado
        }
        return view('back.pages.admin.profile', compact('admin'));
    }
    
}
