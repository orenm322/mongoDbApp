<?php

namespace App\Http\Controllers;

use App\Classes\Posts;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    public function show()
    {
        $cursor = Posts::getPostsList();
        return view('posts.list-posts', ['cursor'=>$cursor]);
    }

    public function viewDetail($id)
     {
        $document = Posts::viewDetail($id);
        return view('posts.view-detail', ['document'=>$document]);
    }

    public function updatePost(Request $request, $id) {
        $validatedData = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        
        
        $title = $request->input("title");
        $body = $request->input("body");
        
        $updateResult = Posts::updatePost($title, $body, $id);

        return redirect('/posts');
    }
}


?>