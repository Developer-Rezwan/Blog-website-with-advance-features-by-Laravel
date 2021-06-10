<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['header']  = 'All Post List';
        $this->data['posts'] = Post::with('category', 'user')
            ->select('id', 'user_id', 'category_id', 'title', 'thumbnail_path', 'status', 'slug')
            ->orderBy('updated_at', 'desc')
            ->where('status', 'published')
            ->orWhere('status', 'pending')
            ->get();
        return view('backend.post.index', $this->backend, $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['categories']  = Category::select('id', 'name', 'status')
            ->where('status', 1)
            ->orderBy('updated_at', 'desc')
            ->get();
        return view('backend.post.create', $this->backend, $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'             => 'required|unique:posts,title|max:200',
            'content'           => 'required',
            'thumbnail_path'    => 'required|image',
            'category_id'       => 'required'
        ]);

        $title          = trim($request->title);
        $content        = $request->content;
        $category_id    = $request->category_id;
        $user_id        = auth()->user()->id;
        $slug           = Str::slug($title);
        $status         = trim($request->status);
        $photo          = $request->file('thumbnail_path');
        $photo_name     = 'photo_user_id_' . $user_id . '_dated_On_' . date('d_M_Y_H:i:s') . '.' . $photo->extension();

        if ($photo->isValid()) {
            $photo->storeAs('backend/images', $photo_name, 'public');
        }
        try {
            Post::create([
                'title'                     => $title,
                'content'                   => $content,
                'thumbnail_path'            => $photo_name,
                'slug'                      => $slug,
                'status'                    => $status,
                'category_id'               => $category_id,
                'user_id'                   => $user_id,
            ]);
            $request->session()->flash('message', 'Your Post Is Successfully Created!!!');
            return redirect()->route('post.index')->with('class', 'alert-success');
        } catch (Exception $e) {
            $request->session()->flash('message', 'Please!!!Try again.Something went wrong!' . $e);
            return redirect()->back()->with('class', 'alert-danger');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $this->data['post'] = Post::with('category', 'user')
            ->where('slug', $slug)
            ->select('title', 'content', 'thumbnail_path', 'user_id', 'category_id', 'status')
            ->get();
        return view('backend.post.show', $this->data, $this->backend);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $this->data['post'] = Post::where('slug', $slug)
            ->select('id', 'title', 'category_id', 'content', 'status', 'thumbnail_path', 'slug')
            ->first();

        /*
        * Without Egerloading for all categories
        */
        $this->data['categories'] = Category::select('id', 'name')
            ->where('status', 1)
            ->orderBy('updated_at', 'desc')
            ->get();
        return view('backend.post.edit', $this->backend, $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'             => 'required|max:100|unique:posts,title,' . $id,
            'content'           => 'required',
            'thumbnail_path'    => 'image'
        ]);

        $post = Post::findOrFail($id);
        $user_id = auth()->user()->id;

        $post->title              = $request->title;
        $post->content            = $request->content;
        $post->status             = $request->status;
        $post->user_id            = $user_id;
        $post->category_id        = $request->category_id;
        if ($request->hasFile('thumbnail_path')) {
            Storage::delete('public/backend/images/' . $post->thumbnail_path);
            $photo                    = $request->file('thumbnail_path');
            $photo_name               = 'photo_id_' . $user_id . '_dated_On_' . date('d_M_Y_H:i:s') . '.' . $photo->extension();
            $post->thumbnail_path     = $photo_name;
            if ($photo->isValid()) {
                $photo->storeAs('backend/images', $photo_name, 'public');
            }
        };
        $post->save();
        $request->session()->flash('message', 'Your data is Successfully Updated!!!');
        return redirect()->route('post.index')->with('class', 'alert-success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->status = 'trashed';
        $post->save();
        session()->flash('message', 'Successfully Moved To Trashed!!!');
        return redirect()->back()->with('class', 'alert-success');
    }

    /*
    * This function is for published data
     */
    public function published()
    {
        $this->data['header']  = 'Published Post List';
        $this->data['posts'] = Post::with('category', 'user')
            ->select('id', 'user_id', 'category_id', 'title', 'thumbnail_path', 'status', 'slug')
            ->orderBy('updated_at', 'desc')
            ->where('status', 'published')
            ->get();
        return view('backend.post.index', $this->backend, $this->data);
    }
    public function pending()
    {
        $this->data['header']  = 'Pending Post List';
        $this->data['posts']   = Post::with('category', 'user')
            ->select('id', 'user_id', 'category_id', 'title', 'thumbnail_path', 'status', 'slug')
            ->orderBy('updated_at', 'desc')
            ->where('status', 'pending')
            ->get();
        return view('backend.post.index', $this->backend, $this->data);
    }

    /*
    * This function is for trashed Data function
     */
    public function trashed()
    {
        $this->data['header']  = 'Trashed Post List';
        $this->data['posts'] = Post::with('category', 'user')
            ->select('id', 'user_id', 'category_id', 'title', 'thumbnail_path', 'status', 'slug')
            ->orderBy('updated_at', 'desc')
            ->where('status', 'trashed')
            ->get();
        return view('backend.post.trashed', $this->backend, $this->data);
    }
    /*
    * This function is for Permanently Delete of the trashed data
    *
     */
    public function trashedToDestroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        Storage::delete('public/backend/images/' . $post->thumbnail_path);
        session()->flash('message', 'Posts Successfully Deleted!!!');
        return redirect()->back()->with('class', 'alert-success');
    }
    /*
    * This function is for restore the trashed post
    * One click and restore the post
     */
    public function restore($slug)
    {
        $post = Post::select('id', 'status')
            ->where('slug', $slug)
            ->get()[0];
        $post->status = 'pending';
        $post->update();
        session()->flash('message', 'Posts Successfully Restored!!!Please check The Pending List');
        return redirect()->back()->with('class', 'alert-success');
    }

    /*
    * Status Update system by clicking
    *
     */
    public function statusUpdate($slug, $status)
    {
        $post = Post::select('id', 'title', 'status')->where('slug', $slug)->get()[0];
        $changeStatus = $status == 'published' ? 'pending' : 'published';
        $post->status = $changeStatus;
        $post->update();

        session()->flash('message', ($changeStatus == 'published' ? "\u{1F606}\u{1F606}\u{1F606} Congratulations! " : "") . 'Your post is now ' . $changeStatus . ' !!!' . ($changeStatus == 'published' ? "\u{1F606}\u{1F606}\u{1F606}" : ''));
        return redirect()->back()->with('class', 'alert-success');
    }
}