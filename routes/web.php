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

Auth::routes(['verify' => true]);

//home route
Route::get('/', 'PostsController@show')->middleware('verified');

//Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('posts')->group(function () {
    //posts pages
    Route::get('/', 'PostsController@show')->name('posts')->middleware('verified');
    Route::get('add', 'PostsController@addPost')->middleware('auth');
    Route::post('add', 'PostsController@insertPost')->middleware('auth');
    Route::get('detail/{id}', 'PostsController@viewDetail')->middleware('auth');
    Route::post('detail/{id}', 'PostsController@updatePost')->middleware('auth');
    Route::get('delete/{id}', 'PostsController@deletePost')->middleware('auth');
});

Route::prefix('reports')->group(function () {
    //reports pages
    Route::get('/', 'ReportsController@showPostsByUserChart');
    Route::get('/posts-by-user', 'ReportsController@showPostsByUserChart');
    Route::get('/posts-by-category', 'ReportsController@showPostsByCategoryChart');
    //Route::get('/map', 'ReportsController@showMap');

});
