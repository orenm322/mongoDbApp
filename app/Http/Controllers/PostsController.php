<?php

namespace App\Http\Controllers;

use App\Classes\Posts;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    public function show(Request $request)
    {
        $page = $request->query('page');
        if(is_null($page)) 
            $page = 1;

        $posts = Posts::getPostsList($page);

        $posts_next = Posts::getPostsList($page+1);

        return view('posts.list-posts', ['posts'=>$posts, 'page'=>$page, 'next_page_count'=>iterator_count($posts_next)]);
    }

    public function addPost(Request $request)
    {
        $document = $request->old();
        if(empty($document) ) {
            $document['meta']['valid'] = 'Y';
        }
        else {
            $document['meta']['valid'] = $document['valid']; //copying to new value to have consistency with insert/update functions on blade template
        }
        $categories = Posts::getCategories();
        
        return view('posts.post-form', ['title'=>'Create Post', 'document'=>$document, 'categories'=>$categories]);
    }

    public function insertPost(Request $request) 
    {

        Posts::validateForm($request);
        
        $title = $request->input("title");
        $body = $request->input("body");
        $category = $request->input("category");
        $valid = $request->input("valid");
        
        $insertOneResult = Posts::insertPost($title, $body, $category, $valid);
        
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
        $valid = $request->input("valid");
        
        $updateResult = Posts::updatePost($title, $body, $category, $valid, $id);

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