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


// Route::get('/{any}', function () {
//     return view('home');
// })->where('any', '.*');


Route::get('/getPosts', 'PostController@getPosts');
Route::post('/removePost/{id}', 'PostController@removePost');
Route::get('/editPost/{id}', 'PostController@editPost');


Route::get('/showTagSuggestion/{tagName}', 'SearchController@showTagSuggestion');

// Route::get('/', function () {
//     return view('home');
// });
// Route::get('/', 'HomeController@index')->name('home');
Route::get('/{any}', 'HomeController@index')->where('any', '.*')->name('home');


// Route::get('/ship', function (Request $request)
// {
//     $id = $request->input('id');
//     event(new CommentPushEvent($id)); // trigger event
//     return Response::make('Order Shipped!');
// });