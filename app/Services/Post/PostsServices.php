<?php

namespace App\Services\Post;

use App\Models\Post;
use Illuminate\Support\Carbon;

class PostsServices
{
    public function getPost($isPinned = false, $onlyTrashed = false, $getAll = false)
    {
        // Determine the timestamp column to use based on the trash status
        $time = $onlyTrashed ? 'deleted_at' : 'created_at';

        // Fetch posts based on trash status and pinned status
        $postsQuery = $onlyTrashed ? Post::onlyTrashed() : Post::query();

        // Load relationships and fields, including the user (post owner)
        $postsQuery = $postsQuery->with([
            'comments:id,post_id,contents,user_id,created_at',
            'comments.user:id,name', // Load comment owners (users) details
            'user:id,name', // Load post owner (user) details
        ])
        ->select(['id', 'user_id', 'caption', 'content', 'privacy', 'created_at'])
        ->withReactionCounts(); // Assuming this is defined in your Post model.

        // Apply filters
        if ($getAll == false) {
            $postsQuery = $postsQuery->where('user_id', request()->user()->id)
                                     ->where('isPinned', $isPinned);
        }

        // Get the posts, apply formatting
        $posts = $postsQuery->latest()->get()->map(function ($post) use ($time) {
            return [
                'id' => $post->id,
                'user_id' => $post->user_id,
                'caption' => $post->caption,
                'content' => $post->content,
                'privacy' => $post->privacy,
                'name' => $post->user->name ?? 'Unknown User', // Handle missing user
                'comments' => $post->comments->map(function ($comment) {
                    return [
                        'id' => $comment->id,
                        'content' => $comment->contents,
                        'user_name' => $comment->user->name ?? 'Unknown User', // Handle missing comment user
                        'time' => Carbon::parse($comment->created_at)->diffForHumans(),
                    ];
                }),
                'time' => Carbon::parse($post->$time)->diffForHumans(),
                'reactions' => [
                    'heart' => $post->heart_count ?? 0,
                    'happy' => $post->happy_count ?? 0,
                    'dislike' => $post->dislike_count ?? 0,
                    'mad' => $post->mad_count ?? 0,
                    'sad' => $post->sad_count ?? 0,
                    'total' => $post->reactions_count ?? 0,
                ],
            ];
        });

        return $posts;
    }

    public function getMyPost(Post $post, $show = false)
    {
        $posts = $show ?
            $posts = Post::withoutTrashed()
                ->with('comments')
                ->withReactionCounts()
                ->where('user_id', request()->user()->id)
                ->where('id', $post->id)
                ->get()
                ->map(function ($post) {

                    return [
                        'id' => $post->id,
                        'user_id' => $post->user_id,
                        'caption' => $post->caption,
                        'content' => $post->content,
                        'privacy' => $post->privacy,

                        'time' => Carbon::parse($post->created_at)->diffForHumans(),
                        'reactions' => [
                            'heart' => $post->heart_count,
                            'happy' => $post->happy_count,
                            'dislike' => $post->dislike_count,
                            'mad' => $post->mad_count,
                            'sad' => $post->sad_count,
                            'total' => $post->reactions_count
                        ],
                        'comments' => $post->comments
                    ];

                })

            : $posts = [
                'id' => $post->id,
                'user_id' => $post->user_id,
                'caption' => $post->caption,
                'content' => $post->content,
                'privacy' => $post->privacy,
            ];

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

