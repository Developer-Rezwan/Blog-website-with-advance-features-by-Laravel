<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $this->data['allPost']    = Post::select()
            ->where('status', 'published')
            ->orWhere('status', 'pending')
            ->count();

        $this->data['pendingPost']  = Post::select()
            ->where('status', 'pending')
            ->count();

        $this->data['category'] = Category::select()->count();

        return view('backend.dashboard', $this->backend, $this->data);
    }
}