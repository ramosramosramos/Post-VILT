<?php

namespace App\Services\Post;

use App\Models\Post;
use Illuminate\Support\Carbon;

class PostsServices
{
    public function getPost($isPinned = false, $onlyTrashed = false)
    {
        // Determine the timestamp column to use based on the trash status
        $time = $onlyTrashed ? 'deleted_at' : 'created_at';

        // Fetch posts based on trash status and pinned status
        $postsQuery = $onlyTrashed ? Post::onlyTrashed() : Post::withoutTrashed()->with(['comments', 'user'])->withReactionCounts();

        $posts = $postsQuery

            ->where('user_id', request()->user()->id)
            ->where('isPinned', $isPinned)
            ->latest()
            ->get()
            ->map(function ($post) use ($time) {

                if ($time == 'created_at') {
                    return [
                        'id' => $post->id,
                        'user_id' => $post->user_id,
                        'caption' => $post->caption,
                        'content' => $post->content,
                        'privacy' => $post->privacy,
                        'comments' => $post->comments->map(function ($comment) {
                            return [
                                'id' => $comment->id,
                                'content' => $comment->contents,
                                'user_name' => $comment->user->name, // Get the comment owner's name
                                'time' => Carbon::parse($comment->created_at)->diffForHumans(),
                            ];
                        }),
                        'time' => Carbon::parse($post->$time)->diffForHumans(),
                        'reactions' => [
                            'heart' => $post->heart_count,
                            'happy' => $post->happy_count,
                            'dislike' => $post->dislike_count,
                            'mad' => $post->mad_count,
                            'sad' => $post->sad_count,
                            'total' => $post->reactions_count
                        ],


                    ];

                }

                return [
                    'id' => $post->id,
                    'user_id' => $post->user_id,
                    'caption' => $post->caption,
                    'content' => $post->content,

                    'time' => Carbon::parse($post->$time)->diffForHumans(),
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

