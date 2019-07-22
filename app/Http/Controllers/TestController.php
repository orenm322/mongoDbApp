<?php

namespace App\Http\Controllers;

use MongoDB;

class TestController extends Controller
{

    public function show()
    {
        
        $cursor = null;
        $client = new MongoDB\Client();
        
    
        $collection = $client->laravelApp->posts;
        

        $cursor = $collection->find();

        // foreach ($cursor as $document) {
        //     echo "<pre>" . print_r($document, true) . "</pre>";
        // }

        return view('test', ['cursor'=>$cursor]);
    }
}
