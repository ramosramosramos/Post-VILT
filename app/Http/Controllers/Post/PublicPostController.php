<?php

namespace App\Http\Controllers\Post;

use App\Services\Post\PostsServices;
use Illuminate\Http\Request;

class PublicPostController
{
    public function index(PostsServices $service)
    {
        // $this->listenQuery();
        $posts = $service->getPost(false,false,true);

        return inertia('Posts/PublicPost', compact('posts'));
    }

}
