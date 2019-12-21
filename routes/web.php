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


Route::post('/createPost/{id}', 'PostController@createPost')->middleware('auth');
Route::get('/getPosts', 'PostController@getPosts');
Route::post('/removePost/{id}', 'PostController@removePost');
Route::get('/editPost/{id}', 'PostController@editPost');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
