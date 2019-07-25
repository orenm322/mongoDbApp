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

    public function addPost()
    {
        return view('posts.post-form', ['title'=>'Create Post']);
    }

    public function insertPost(Request $request) 
    {

        Posts::validateForm($request);
        
        $title = $request->input("title");
        $body = $request->input("body");
        
        $updateResult = Posts::insertPost($title, $body);

        return redirect('/posts');
    }

    public function viewDetail($id)
    {
        $document = Posts::viewDetail($id);
        return view('posts.post-form', ['title'=>'View Post Detail','document'=>$document]);
    }

    public function updatePost(Request $request, $id) 
    {
        Posts::validateForm($request);
        
        $title = $request->input("title");
        $body = $request->input("body");
        
        $updateResult = Posts::updatePost($title, $body, $id);

        return redirect('/posts');
    }

    public function deletePost($id)
    {
        $updateResult = Posts::deletePost($id);

        return redirect('/posts');
    }

    
}


?>