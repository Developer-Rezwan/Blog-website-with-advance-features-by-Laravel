<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    public function index()
    {
        $this->data['posts'] = cache('posts', function () {
            return Post::with('user')
                ->select('user_id', 'slug', 'title', 'content', 'updated_at', 'thumbnail_path')
                ->orderBy('updated_at', 'desc')
                ->where('status', 'published')
                ->simplePaginate(10);
        });

        $this->data['categories'] = cache('categories', function () {
            Category::select('name')
                ->where('status', 1)
                ->get();
        });
        return view('frontend.welcome', $this->data);
    }
}