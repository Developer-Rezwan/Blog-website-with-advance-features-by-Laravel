<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\VerifyEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function loginView()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('backend.auth.login', $this->backend);
    }

    public function loginDataStore(Request $request)
    {
        $request->validate([
            'email' => "required|email",
            'password' => "required"
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::attempt(['email' => $email, 'password' => $password])) {

            /*
            * Find the unvaried user
            */
            $unvarified_user = Auth::user();
            if ($unvarified_user->email_varified == 0) {
                $unvarified_user->notify(new VerifyEmail($unvarified_user));
                Auth::logout();
                $request->session()->flash('error', "You account is not activated. Please check the mail inbox and verify your email.");
                return redirect()->route('login');
            }
            /*
            * Login time update
            */
            $user = Auth::user();
            $user->login_at = Carbon::now();
            $user->update();

            Alert::success('Welcome', 'You are successfully logged in!');
            return redirect()->route('dashboard');
        } else {
            $request->session()->flash('error', 'Invalid Credentials ! Please,Try again.');
            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('welcome');
    }
}