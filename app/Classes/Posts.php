<?php

namespace App\Classes;
use MongoDB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Posts {

    public static function getCollection()
    {
        $client = new MongoDB\Client( env("MONGODB_HOST") );
        return $client->laravelApp->posts;
    }

    public static function validateForm(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:10',
            'body' => 'required',
            'category' => 'required|array'
        ]);
    }

    public static function getCategories() {
        return ["Tech", "Sports", "Politics", "US", "World"];
    }
    
    public static function getPostsList() {
        
        $users = [];
        $users = DB::collection('posts')->paginate(5);
        return $users;
    }

    public static function insertPost($title, $body, $category) 
    {
        $collection = self::getCollection();
        $insertOneResult = $collection->insertOne([
            'title' => $title, 
            'body' => $body,
            'category' => $category,
            'created_date' => new MongoDB\BSON\UTCDateTime,
            'updated_date' => new MongoDB\BSON\UTCDateTime
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

    public static function updatePost($title, $body, $category, $id) 
    {
        $collection = self::getCollection();
        
        $updateResult = $collection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($id) ],
            ['$set' => [
                'title' => $title, 
                'body' => $body,
                'category' => $category,
                'updated_date' => new MongoDB\BSON\UTCDateTime
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