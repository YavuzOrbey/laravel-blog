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

Route::get('/', 'PagesController@getIndex');

Route::get('about', 'PagesController@getAbout');
Route::get('contact', 'ContactController@create');
Route::post('contact', 'ContactController@store')->name('contact.store'); //route name for controller action
Route::get('blog/{slug}', 'BlogController@getSingle')->middleware('web')->name('blog.single');
Route::resource('posts','PostController');