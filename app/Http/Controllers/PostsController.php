<?php

namespace App\Http\Controllers;

use App\Classes\Posts;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $users = Posts::getPostsList();

        return view('posts.list-posts', ['users'=>$users]);
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
        
        $insertOneResult = Posts::insertPost($title, $body);
        
        $err = $insertOneResult == 0 ? ["Failed to insert post"] : [];

        return redirect()->route('posts')->withErrors($err);

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

        $err = $updateResult == 0 ? ["Failed to update post"] : [];

        return redirect()->route('posts')->withErrors($err);

    }

    public function deletePost($id)
    {
        $deleteResult = Posts::deletePost($id);

        $err = $deleteResult == 0 ? ["Failed to delete post"] : [];

        return redirect()->route('posts')->withErrors($err);
    }

    
}


?>