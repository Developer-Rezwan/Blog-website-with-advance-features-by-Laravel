<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use App\Models\Category;

class PostListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //__construct
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Cache::forget('posts');
        $post = Post::with('user')
            ->select('user_id', 'slug', 'title', 'content', 'updated_at', 'thumbnail_path')
            ->orderBy('updated_at', 'desc')
            ->where('status', 'published')
            ->take(10)
            ->get();
        Cache::forever('posts', $post);
    }
}