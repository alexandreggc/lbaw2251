<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class ForgotPasswordController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showForgetPasswordForm(){
        return view('auth.forgot-password');
    }

    public function submitForgetPasswordForm(Request $request){
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink(
            $request->only('email')
        );
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    public function showResetPasswordForm($token){
        return view('auth.reset-password', ['token' => $token]);

    }

    public function submitResetPasswordForm(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $tokenData = DB::table('password_resets')->where('email', $request->email)->first();
        echo $request['token'];
        echo '<br>';
        echo (Hash::make($request['token']));
        echo '<br>';
        echo $tokenData->token;
        echo '<br>';
        if(bcrypt($request['token']) == $tokenData->token){
            echo 1;
        }
        else{
            echo 0;
        }

        

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                
                $user->save();
    
                event(new PasswordReset($user));
            }
        );
        echo '<br>';
        echo $status;

        /*return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);*/
    }
}