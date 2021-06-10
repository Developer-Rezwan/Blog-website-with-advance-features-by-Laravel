<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\NotifyAdmin;
use App\Notifications\VerifyEmail;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SignUpController extends Controller
{
    public function signUpView()
    {
        if (!Auth::check()) {
            return view('backend.auth.sign-up', $this->backend);
        }
        return redirect()->back();
    }

    public function signUpDataStore(Request $request)
    {
        $request->validate([
            'fullName'          => 'required',
            'email'             => 'required|email|unique:users,email',
            'password'          => 'required|confirmed',
            'photo'             => 'required|image|min:100|max:2048',
            'phone_number'      => 'required|numeric'
        ]);

        $this->data['fullName']                 = $request->input('fullName');
        $this->data['email']                    = Str::lower(trim($request->input('email')));
        $this->data['password']                 = Hash::make($request->input('password'));
        $this->data['phone_number']             = $request->input('phone_number');
        $this->data['email_varification_token'] = Str::random(32);
        $this->data['email_varified']           = 0;
        $this->data['role']                     = 'author';

        $photo = $request->file('photo');
        $fileName = 'photo_' . $request->input('fullName') . Str::random(10) . '.' . $photo->extension();

        $this->data['photo']    = $fileName;
        if ($photo->isValid()) {
            $photo->storeAs('backend/images', $fileName, 'public');
        }

        try {
            /*
            * Create a new user
            */
            $user = User::create($this->data);

            /*
            * Notification system using database
            */
            $admins = User::where('role', 'CEO')
                ->orWhere('role', 'admin')
                ->get();
            foreach ($admins as $admin) {
                $admin->notify(new NotifyAdmin($user));
            }

            /*
            * Validation link send by this way
            */
            $user->notify(new VerifyEmail($user));

            $request->session()->flash('status', 'Registration Success.You Need To Verify your Email !!!');
            return redirect()->route('login')->with('class', 'alert-success');
        } catch (Exception $e) {
            $request->session()->flash('message', "Something went wrong!" . $e->getMessage());
            return redirect()->back()->with('class', 'alert-danger');
        }
    }

    public function verifyEmail($token = null)
    {
        if ($token === null) {
            session()->flash('error', 'Invalid Verify Attempt! Please,Try again.');
            return redirect()->route('login');
        }

        $user = User::select('id', 'email_varification_token', 'email_varified')
            ->where('email_varification_token', $token)
            ->first();

        if ($user === null) {
            session()->flash('error', "Token doesn't match!");
            return redirect()->route('login');
        }

        if ($user->email_varified == 1) {
            session()->flash('error', "The email is already varified!");
            return redirect()->route('login');
        }

        $user->email_varified           = 1;
        $user->email_verified_at        = Carbon::now();
        if ($user->update()) {
            session()->flash('status', "\u{1F606}\u{1F606}\u{1F606} Congratulations! Your account is activated.You can login now.");
            return redirect()->route('login')->with('class', 'alert-success');
        }
    }
}