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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

//home route
Route::get('/', 'PostsController@show');

//Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('posts')->group(function () {
    //posts pages
    Route::get('/', 'PostsController@show')->name('posts');
    Route::get('add', 'PostsController@addPost')->middleware('auth');
    Route::post('add', 'PostsController@insertPost')->middleware('auth');
    Route::get('detail/{id}', 'PostsController@viewDetail')->middleware('auth');
    Route::post('detail/{id}', 'PostsController@updatePost')->middleware('auth');
    Route::get('delete/{id}', 'PostsController@deletePost')->middleware('auth');
});

Route::prefix('reports')->group(function () {
    //reports pages
    Route::get('/', 'ReportsController@showPostsByAuthorChart');
    //Route::get('/map', 'ReportsController@showMap');

});
