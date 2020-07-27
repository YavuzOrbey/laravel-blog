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


Route::get('/posts/{post}/comments', 'CommentController@apiIndex');
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/messages/{user_to}', 'PrivateMessageController@index');
    Route::post('/messages/{user_to}', 'PrivateMessageController@store');
    Route::post('/posts/{post}/comment', 'CommentController@apiStore');
    Route::get('/users', 'UserController@apiIndex');
});
