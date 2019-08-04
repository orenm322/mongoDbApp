<?php

namespace App\Http\Controllers;

use App\Classes\Posts;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    public function show()
    {
        $users = Posts::getPostsList();

        return view('posts.list-posts', ['users'=>$users]);
    }

    public function addPost(Request $request)
    {
        $document = $request->old();
        $categories = Posts::getCategories();
        
        return view('posts.post-form', ['title'=>'Create Post', 'document'=>$document, 'categories'=>$categories]);
    }

    public function insertPost(Request $request) 
    {

        Posts::validateForm($request);
        
        $title = $request->input("title");
        $body = $request->input("body");
        $category = $request->input("category");
        
        $insertOneResult = Posts::insertPost($title, $body, $category);
        
        $err = $insertOneResult == 0 ? ["Failed to insert post"] : [];

        return redirect()->route('posts')->withInput()->withErrors($err);

    }

    public function viewDetail(Request $request, $id)
    {
        $document = $request->old();
        if(empty($document) ) {
            $document = Posts::viewDetail($id);
        }

        $categories = Posts::getCategories();
    
        return view('posts.post-form', ['title'=>'View Post Detail','document'=>$document, 'categories'=>$categories]);
    }

    public function updatePost(Request $request, $id) 
    {
        Posts::validateForm($request);
        
        $title = $request->input("title");
        $body = $request->input("body");
        $category = $request->input("category");
        
        $updateResult = Posts::updatePost($title, $body, $category, $id);

        $err = $updateResult == 0 ? ["Failed to update post"] : [];

        return redirect()->route('posts')->withInput()->withErrors($err);

    }

    public function deletePost($id)
    {
        $deleteResult = Posts::deletePost($id);

        $err = $deleteResult == 0 ? ["Failed to delete post"] : [];

        return redirect()->route('posts')->withErrors($err);
    }

    
}


?>