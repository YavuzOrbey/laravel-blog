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
Route::get('blog', 'BlogController@getIndex')->name('blog.index');
Route::get('blog/{slug}', 'BlogController@getSingle')->name('blog.single')->where('slug', '[\w\d\-\_]+');
//Route::get('{username}/blog', 'BlogController@getUserIndex')
Route::resource('posts','PostController'); // testing purposes!!

Auth::routes(); //using artisan command php artisan make:auth sets up routing, controllers, views etc.

/* for some reason a get request isnt created for logout but just in case a user decides to type the website name/logout we can:
    1. If he's a guest and accessing the page (for whatever reason) we can give a 404 error
    2. If he's logged in then log him or her out
*/
Route::get('logout', 'Auth\LoginController@logout', function () {
    return abort(404);
});
Route::get('/home', 'HomeController@index')->name('home');
