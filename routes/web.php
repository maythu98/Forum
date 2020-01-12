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

use App\Events\CommentPushEvent;

Route::get('/', function () {
    return view('home');
});


Route::post('/createPost/{id}', 'PostController@createPost')->middleware('auth');
Route::get('/getPosts', 'PostController@getPosts');
Route::post('/removePost/{id}', 'PostController@removePost');
Route::get('/editPost/{id}', 'PostController@editPost');

Route::get('/showPost/{id}', 'PostController@showPost');

Auth::routes();

// Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::post('/saveComment/{id}', 'PostController@saveComment');

// Route::get('/ship', function (Request $request)
// {
//     $id = $request->input('id');
//     event(new CommentPushEvent($id)); // trigger event
//     return Response::make('Order Shipped!');
// });