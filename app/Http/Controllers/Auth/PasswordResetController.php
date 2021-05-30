<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\VerifyPhoneNumber;
use Nexmo\Laravel\Facade\Nexmo;

class PasswordResetController extends Controller
{
    public function forgetPasswordView()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('backend.auth.reset-password', $this->backend);
    }

    public function forgetPasswordProccess(Request $request)
    {
        $request->validate([
            'email'     => 'required|email'
        ]);

        $email = trim($request->email);
        $user = User::where('email', $email)->first();
        $code = rand(100000, 999999);
        if ($user !== null) {
            $user->code   = $code;
            $user->update();
            /* Nexmo::message()->send([
                'to'   => $user->phone_number,
                'from' => 'Dev-Rezwan',
                'text' => 'Thanks for reset your password.Your verification code is ' . $code
            ]); */
            $user->notify(new VerifyPhoneNumber($code));
            $request->session()->flash('success', "\u{1F973}\u{1F973}\u{1F973}Successfully send a verification code to " . substr($user->phone_number, 0, 5) . "****" . substr($user->phone_number, -4));
            return view('backend.auth.code', $this->backend);
        } else {
            $request->session()->flash('error', "\u{1F625}\u{1F625}\u{1F625} Email Doesn't Matched!");
            return view('backend.auth.reset-password', $this->backend);
        }
    }

    public function phoneNumberVerificationProcess(Request $request)
    {
        $request->validate([
            'code'  =>  'required|min:6|max:6'
        ]);
        $user   = User::where('code', $request->code)->first();
        if ($user !== null) {
            $request->session()->put('reseted_email', $user->email);
            return redirect()->route('new.password');
        } else {
            return redirect()->back();
        }
    }

    public function setNewPasswordView()
    {
        if (session()->has('reseted_email')) {
            return view('backend.auth.new-password', $this->backend);
        }
        return redirect()->route('forget.password');
    }

    public function storeNewPassword(Request $request)
    {
        $request->validate([
            'password'  => 'required|min:6|max:8|confirmed'
        ]);

        $email = $request->session()->get('reseted_email');

        $user = User::select('id', 'password', 'code')
            ->where('email', $email)
            ->first();
        if ($user !== null) {
            $user->password = Hash::make($request->password);
            $user->code     = null;
            $user->update();

            $request->session()->remove('reseted_email');
            $request->session()->flash('status', "\u{1F64B}Congratulations! You should login now by New Password");
            return \redirect()->route('login')->with('class', 'alert-success');
        } else {
            $request->session()->remove('reseted_email');
            $request->session()->flash('status', "\u{1F625}Something went wrong.Please try with valid Information!");
            return \redirect()->route('forget.password')->with('class', 'alert-warning');
        }
    }
}