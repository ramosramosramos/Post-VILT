<?php

namespace App\Services\Post;

use App\Models\Post;
use Illuminate\Support\Carbon;

class PostsServices
{
    public function getPost($isPinned = false, $onlyTrashed = false)
    {
        $time= $onlyTrashed ? 'deleted_at':'created_at';
        // dd($time);
        $type = $onlyTrashed ? Post::onlyTrashed() : Post::withoutTrashed();
        $posts = $type->select(['id', 'user_id', 'caption', 'content', $time])
            ->where('user_id', request()->user()->id)
            ->where('isPinned', $isPinned)
            ->latest()
            ->get()
            ->map(fn($post) => [
                'id' => $post->id,
                'user_id' => $post->user_id,
                'caption' => $post->caption,
                'content' => $post->content,
                'time' => Carbon::parse($post->$time)->diffForHumans(),
            ]);

        return $posts;
    }

    public function isPinThePost(Post $post, $isPinned = false)
    {

        $post->update([
            'isPinned' => $isPinned,
        ]);
    }
    public function find($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        return $post;


    }

}
