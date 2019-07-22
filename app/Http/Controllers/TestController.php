<?php

namespace App\Http\Controllers;

use MongoDB\Client;

class TestController extends Controller
{

    public function show(Client $client)
    {
        
        $cursor = null;
        $collection = $client->laravelApp->posts;
        $cursor = $collection->find();

        return view('test', ['cursor'=>$cursor]);
    }
}
