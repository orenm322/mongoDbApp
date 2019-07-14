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
    
    $collection = $client->flights->passengers;

    $cursor = $collection->find(['age' => ['$lt' => 30] ]); //find passengers with age < 30

    foreach ($cursor as $document) {
        echo "<pre>" . print_r($document, true) . "</pre>";
    }

    
});
