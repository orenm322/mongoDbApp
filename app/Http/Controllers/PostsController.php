<?php

namespace App\Http\Controllers;

use App\Classes\Posts;

class PostsController extends Controller
{

    public function show()
    {
        $cursor = Posts::getPostsList();

        return view('posts.list-posts', ['cursor'=>$cursor]);
    }
}


?>