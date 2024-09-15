<?php

namespace App\Http\Controllers\Post;

use App\Http\Requests\Post\StoreReactionRequest;
use App\Services\DBQueryListener;
use Illuminate\Http\Request;

class ReactionController extends DBQueryListener
{
    public function reaction(StoreReactionRequest $request){
        $this->listenQuery();
        dd($request->all());
    }
}
