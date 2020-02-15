<?php

use Illuminate\Http\Request;

Route::post('register', 'RegisterController@register');
Route::post('login', 'RegisterController@login');
Route::get('/showPost/{id}', 'PostController@showPost');
Route::get('/getPosts', 'PostController@getPosts');
Route::get('/showTagSuggestion/{tagName}', 'SearchController@showTagSuggestion');
Route::get('/increaseCount', 'PostController@increaseCount');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('user', 'RegisterController@getAuthenticatedUser');
    Route::get('/editPost/{id}', 'PostController@editPost');
    Route::post('refresh', 'RegisterController@refresh');
    Route::post('logout', 'RegisterController@logout');
    Route::post('/createPost/{id}', 'PostController@createPost');
    Route::post('/removePost/{id}', 'PostController@removePost');
    Route::post('/saveComment/{id}', 'PostController@saveComment');
});