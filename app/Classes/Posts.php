<?php

namespace App\Classes;
use MongoDB;

class Posts {

    public static function getPostsList() {
        
        $client = new MongoDB\Client( env("MONGODB_HOST") );
        $cursor = [];
        $collection = $client->laravelApp->posts;
        $cursor = $collection->find();
        return $cursor;
    }

    public static function viewDetail($id) {
        $client = new MongoDB\Client( env("MONGODB_HOST") );
        $document = [];
        $collection = $client->laravelApp->posts;
        $document = $collection->findOne([
                        "_id" => new MongoDB\BSON\ObjectId($id)
                    ]);
        return $document;
    }

    public static function updatePost($title, $body, $id) {
        $client = new MongoDB\Client( env("MONGODB_HOST") );
        $collection = $client->laravelApp->posts;
        
        $updateResult = $collection->updateOne(
                            ['_id' => new MongoDB\BSON\ObjectId($id) ],
                            ['$set' => ['title' => $title, 'body' => $body]]
                        );
        
        return $updateResult->getMatchedCount();
    }
}

?>