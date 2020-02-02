<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', 'RegisterController@register');
Route::post('login', 'RegisterController@authenticate');
Route::get('/showPost/{id}', 'PostController@showPost');

Route::group(['middleware' => ['jwt.verify']], function() {

    Route::get('user', 'RegisterController@getAuthenticatedUser');
    Route::post('refresh', 'RegisterController@refresh');
    Route::post('logout', 'RegisterController@logout');

    Route::post('/createPost/{id}', 'PostController@createPost');

    Route::post('/saveComment/{id}', 'PostController@saveComment');
});
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
