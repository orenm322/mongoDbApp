<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    $client = new MongoDB\Client();
    
    $collection = $client->laravelApp->posts;
    

    $cursor = $collection->find();

    foreach ($cursor as $document) {
        echo "<pre>" . print_r($document, true) . "</pre>";
    }

    
});
