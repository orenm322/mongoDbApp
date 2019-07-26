<?php

namespace App\Classes;
use MongoDB;
use Illuminate\Http\Request;

class Posts {

    public static function getCollection()
    {
        $client = new MongoDB\Client( env("MONGODB_HOST") );
        return $client->laravelApp->posts;
    }

    public static function validateForm(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
    }
    
    public static function getPostsList() {
        
        $cursor = [];
        $collection = self::getCollection();
        $cursor = $collection->find();
        return $cursor;
    }

    public static function insertPost($title, $body) 
    {
        $collection = self::getCollection();
        $insertOneResult = $collection->insertOne([
            'title' => $title, 
            'body' => $body,
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

        return $document;
    }

    public static function updatePost($title, $body, $id) 
    {
        $collection = self::getCollection();
        
        $updateResult = $collection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($id) ],
            ['$set' => [
                'title' => $title, 
                'body' => $body,
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