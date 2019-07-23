<?php

namespace App\Classes;
use MongoDB;

class Posts {
    
    public static function getPostsList() {
        $client = new MongoDB\Client();
        $cursor = [];
        $collection = $client->laravelApp->posts;
        $cursor = $collection->find();
        return $cursor;
    }
}

?>