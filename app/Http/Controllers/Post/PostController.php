<?php

namespace App\Http\Controllers\Post;

use App\Http\Requests\Post\StoreReactionRequest;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Reaction;
use App\Services\DBQueryListener;
use App\Services\Post\PostsServices;


class PostController extends DBQueryListener
{

    public function index(PostsServices $service)
    {
        // $this->listenQuery();
        $posts = $service->getPost();
        $pinnedPosts = $service->getPost(true);

        return inertia('Posts/Index', compact('posts', 'pinnedPosts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Posts/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        Post::create($request->validated());
        return redirect()->route('posts.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post ,PostsServices $service)
    {
        $posts = $service->getMyPost($post,true);
        return inertia('Posts/Show', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post,PostsServices $service)
    {
        $myPost = $service->getMyPost($post);
        return inertia('Posts/Edit', compact('myPost'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->validated());
        return redirect()->route('posts.index')->with("updated", "Updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->deleteOrFail();
        return redirect()->route('posts.index')->with("deleted", "Successfully move to trash.");
    }



    // ---------------------related posts functions ----------------------
    // ---------------------related posts functions ----------------------

    public function indexTrash(PostsServices $service)
    {

        $posts = $service->getPost(false, true);
        return inertia('Posts/Trash', ['posts' => $posts]);
    }

    public function restore($id, PostsServices $service)
    {
        $service->find($id)->restore();
        return redirect()->back()->with("restored", "The post has been restored.");

    }
    public function forceDestroy($id, PostsServices $service)
    {
        $service->find($id)->forceDelete();
        return redirect()->route('posts.index')->with("deleted", "The post is now permanently deleted.");
    }

    public function pinPost(Post $post, PostsServices $service)
    {
        $service->isPinThePost($post, true);
        return redirect()->back()->with('pinned', "Post has been pinned successfully.");
    }
    public function unpinPost(Post $post, PostsServices $service)
    {
        $service->isPinThePost($post);
        return redirect()->back()->with('pinned', "Post has been pinned successfully.");
    }



    public function storeReaction(StoreReactionRequest $request)
    {
        Reaction::updateOrCreate(
            [
                'user_id' => $request->user_id,
                'reactable_id' => $request->reactable_id,
                'reactable_type' => $request->reactable_type,
            ],
            [
                'type' => $request->type
            ]
        );

        return redirect()->back();


    }
}
