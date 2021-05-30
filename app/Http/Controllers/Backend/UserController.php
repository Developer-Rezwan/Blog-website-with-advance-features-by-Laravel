<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function show($user_id, $notification_id)
    {
        $user = User::findOrFail($user_id);
        $user->unreadNotifications
            ->where('id', $notification_id)
            ->markAsread();
        $this->data['user'] = $user;
        return view('backend.user.index', $this->data, $this->backend);
    }

    /*
    * User Profile management function
    */
    public function profileView()
    {
        $id = auth()->user()->id;
        $this->data['user'] = User::with('posts', 'about')->findOrFail($id)->first();
        return view('backend.user.profile', $this->backend, $this->data);
    }

    public function profileUpdate(Request $request)
    {
        $user_id = auth()->user()->id;
        $request->validate([
            'fullName'          => 'required',
            'email'             => 'required|email|unique:users,email,' . $user_id,
            'password'          => 'confirmed',
            'phone_number'      => 'required|numeric',
            'education'         => 'required',
            'skills'            => 'required',
            'location'          => 'required',
            'description'       => 'required'
        ]);

        /*
        * User table data update
        */
        $user = User::findOrFail($user_id);
        $user->fullName        = $request->input('fullName');
        $user->email           = $request->input('email');
        $user->phone_number    = $request->input('phone_number');
        $user->password        = $request->input('password') !== null ? Hash::make($request->input('password')) : $user->password;
        if ($request->hasFile('photo')) {
            Storage::delete('public/backend/images/' . $user->photo);
            $photo           = $request->file('photo');
            $photo_name      = 'photo_id_' . $user_id . '_dated_On_' . date('d_M_Y_H:i:s') . '.' . $photo->extension();
            $user->photo     = $photo_name;
            if ($photo->isValid()) {
                $photo->storeAs('backend/images', $photo_name, 'public');
            }
        };
        $user->update();
        /*
        * About Table data update
        */
        $about = About::where('user_id', $user_id)->first();
        if ($about !== null) {
            $about->education       = $request->input('education');
            $about->skills          = $request->input('skills');
            $about->location        = $request->input('location');
            $about->description     = $request->input('description');
            $about->update();
        } else {
            About::create([
                'user_id'         => $user_id,
                'education'       => $request->input('education'),
                'skills'          => $request->input('skills'),
                'location'        => $request->input('location'),
                'description'     => $request->input('description')
            ]);
        }

        $request->session()->flash('message', 'Your data is Successfully Updated!!!');
        return redirect()->back()->with('class', 'alert-success');
    }

    public function allUserView()
    {
        $this->data['users'] = User::with('about', 'posts')
            ->whereKeyNot(auth()->user()->id)
            ->select('id', 'fullName', 'role', 'phone_number', 'photo')
            ->simplePaginate(9);
        return view('backend.user.all', $this->backend, $this->data);
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        session()->flash('message', 'Your data is move to trashed !!!');
        return redirect()->back()->with('class', 'alert-success');
    }

    public function trashed()
    {
        $this->data['users'] = User::select()->onlyTrashed()->get();
        return \view('backend.user.trashed', $this->backend, $this->data);
    }

    public function restore($id)
    {
        $id = \decrypt($id);
        User::where('id', $id)->restore();
        session()->flash('message', 'Your data is successfully restored !!!');
        return redirect()->back()->with('class', 'alert-success');
    }
}