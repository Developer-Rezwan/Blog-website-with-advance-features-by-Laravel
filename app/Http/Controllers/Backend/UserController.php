<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\User;
use App\Models\About;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Notifications\NotifyAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function create()
    {
        return view('backend.user.add-new', $this->backend);
    }

    public function store(Request $request)
    {
        $request->validate([
            'fullName'          => 'required',
            'email'             => 'required|email|unique:users,email',
            'password'          => 'required|confirmed',
            'photo'             => 'required|image|min:100|max:2048',
            'phone_number'      => 'required|numeric',
            'education'         => 'required|max:150',
            'skills'            => 'required|max:150',
            'location'          => 'required|max:150',
            'description'       => 'required|max:200'
        ]);
        $this->data['fullName']                 = $request->input('fullName');
        $this->data['email']                    = Str::lower(trim($request->input('email')));
        $this->data['password']                 = Hash::make($request->input('password'));
        $this->data['phone_number']             = $request->input('phone_number');
        $this->data['email_varification_token'] = Str::random(32);
        $this->data['email_varified']           = 1;
        $this->data['role']                     = $request->input('role');

        $photo = $request->file('photo');
        $fileName = uniqid('photo_', true) . Str::random(10) . '.' . $photo->extension();

        $this->data['photo']    = $fileName;
        if ($photo->isValid()) {
            $photo->storeAs('backend/images', $fileName, 'public');
        }

        try {
            /*
            * Create a new user
            */
            $user = User::create($this->data);

            About::create([
                'user_id'         => $user->id,
                'education'       => $request->input('education'),
                'skills'          => $request->input('skills'),
                'location'        => $request->input('location'),
                'description'     => $request->input('description')
            ]);

            /*
            * Notification system using database
            */
            $admins = User::where('role', 'admin')
                ->Where('role', 'CEO')
                ->get();
            foreach ($admins as $admin) {
                $admin->notify(new NotifyAdmin($user));
            }

            $request->session()->flash('message', 'User Successfully Registered!!!');
            return redirect()->back()->with('class', 'alert-success');
        } catch (Exception $e) {
            $request->session()->flash('message', "Something went wrong!" . $e->getMessage());
            return redirect()->back()->with('class', 'alert-danger');
        }
    }

    public function show($id, $notification_id = null)
    {
        if ($notification_id !== null) {
            $notified_user = auth()->user();
            $notified_user->unreadnotifications
                ->where('id', $notification_id)
                ->markAsRead();
        }

        $user_id = decrypt($id) ? decrypt($id) : $id;
        $this->data['user'] = User::findOrFail($user_id);
        return view('backend.user.show', $this->data, $this->backend);
    }

    /*
    * User Profile management function
    */
    public function profileView()
    {
        return view('backend.user.profile', $this->backend);
    }

    public function profileUpdate(Request $request, $id)
    {
        $user_id =  $id;
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
        $user->role            = $request->input('role') ?? $user->role;
        if ($request->hasFile('photo')) {
            Storage::delete('public/backend/images/' . $user->photo);
            $photo           = $request->file('photo');
            $photo_name      = 'photo_id_' . $request->input('fullName') . '_dated_On_' . date('d_M_Y_H:i:s') . '.' . $photo->extension();
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
        $this->data['page_title'] = 'All Users';
        $this->data['users'] = User::with('about', 'posts')
            ->whereKeyNot(auth()->user()->id)
            ->select('id', 'fullName', 'role', 'phone_number', 'photo', 'email_varified')
            ->orderBy('id', 'desc')
            ->simplePaginate(9);
        return view('backend.user.all', $this->backend, $this->data);
    }

    public function admins()
    {
        $this->data['page_title'] = 'All Admins';
        $this->data['users'] = User::with('about', 'posts')
            ->whereKeyNot(auth()->user()->id)
            ->select('id', 'fullName', 'role', 'phone_number', 'photo')
            ->where('role', 'admin')
            ->simplePaginate(9);
        return view('backend.user.all', $this->backend, $this->data);
    }

    public function authors()
    {
        $this->data['page_title'] = 'All Authors';
        $this->data['users'] = User::with('about', 'posts')
            ->whereKeyNot(auth()->user()->id)
            ->select('id', 'fullName', 'role', 'phone_number', 'photo')
            ->where('role', 'author')
            ->simplePaginate(9);
        return view('backend.user.all', $this->backend, $this->data);
    }

    public function contributors()
    {
        $this->data['page_title'] = 'All Contributors';
        $this->data['users'] = User::with('about', 'posts')
            ->whereKeyNot(auth()->user()->id)
            ->select('id', 'fullName', 'role', 'phone_number', 'photo')
            ->where('role', 'contributor')
            ->simplePaginate(9);
        return view('backend.user.all', $this->backend, $this->data);
    }

    public function destroy($id)
    {
        $alert = alert()->success('Are you sure?', 'You won\'t be able to revert this!')
            ->showConfirmButton('Yes! Delete it', '#3085d6')
            ->showCancelButton('Cancel', '#aaa')->reverseButtons()->focusConfirmButton(true);

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

    public function permanentlyDelete($id)
    {
        try {
            User::select()->withTrashed()->where('id', $id)->forceDelete();
            session()->flash('message', 'Your data is successfully Deleted !!!');
            return redirect()->back()->with('class', 'alert-success');
        } catch (Exception $e) {
            session()->flash('message', 'Sorry you cannot delete this data.Please firstly delete the refferences table' . $e->getmessage());
            return redirect()->back()->with('class', 'alert-danger');
        }
    }
}