<?php

namespace App\Classes;
use MongoDB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Posts {

    public static $limit = 5;
    public static $categories = ["Tech", "Sports", "Politics", "US", "World"];
    public static $paginationRange = 2;
    
    public static function getCollection()
    {
        $client = new MongoDB\Client( env("MONGODB_HOST") );
        return $client->laravelApp->posts;
    }

    public static function validateForm(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:10|max:50',
            'body' => 'required',
            'category' => 'required|array',
            'valid' => 'required'
        ]);
    }

    public static function getCategories() {
        return self::$categories;
    }

    public static function getPaginationRange() {
        return self::$paginationRange;
    }

    public static function getPostsList($startPage, $endPage) {
        
        $posts = [];

        if($startPage < 1)
            $startPage = 1; //validation of $startPage value
        if($endPage < $startPage)
            $endPage = $startPage; //validate of $endPage value
 
        $limit = self::$limit * ($endPage - $startPage);
        $skip = ($startPage -1) * self::$limit;

        if($limit <= 0)
            return $posts;
        
        $collection = self::getCollection();
        $posts = $collection->aggregate([
            ['$lookup' => ['from'=> 'users', 'localField' => 'meta.author', 'foreignField' => '_id', 'as' => 'author_detail'] ],
            ['$project' => ['_id'=> 1, 'title' => 1, 'created_date'=> 1, 'updated_date' => 1, 'author_detail._id' => 1, 'author_detail.name' => 1] ],
            ['$skip' => $skip],
            ['$limit' => $limit]
        ]);

        return $posts;
    }

    public static function getPostPageCount($posts_cursor) {   
        return ceil(iterator_count($posts_cursor) / self::$limit);
    }

    public static function insertPost($title, $body, $category, $valid) 
    {
        $collection = self::getCollection();
        $insertOneResult = $collection->insertOne([
            'title' => $title, 
            'body' => $body,
            'category' => $category,
            'created_date' => new MongoDB\BSON\UTCDateTime,
            'updated_date' => new MongoDB\BSON\UTCDateTime,
            'meta' => [
                'author' => new MongoDB\BSON\ObjectId(Auth::user()->_id),
                'valid' => $valid
            ]
            
        ]);
        
        return $insertOneResult->getInsertedCount();
    }

    public static function viewDetail($id) 
    {
        $document = [];
        
        $collection = self::getCollection();

        $document = $collection->findOne([
             "_id" => new MongoDB\BSON\ObjectId($id)
        ]);
        
        if(isset($document['category']))
            $document['category'] = iterator_to_array($document['category']); //converts BSONArray to PHP array

        return $document;
    }

    public static function updatePost($title, $body, $category, $valid, $id) 
    {
        $collection = self::getCollection();
        
        $updateResult = $collection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($id) ],
            ['$set' => [
                'title' => $title, 
                'body' => $body,
                'category' => $category,
                'updated_date' => new MongoDB\BSON\UTCDateTime,
                'meta.valid' => $valid
                ] 
            ]
        );
        
        return $updateResult->getMatchedCount();
    }

    public static function deletePost($id)
    {
        $collection = self::getCollection();

        $deleteResult = $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id) ]);
        
        return $deleteResult->getDeletedCount();
    }
}

?>