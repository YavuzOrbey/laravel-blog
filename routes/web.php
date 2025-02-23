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

Route::get('contact', 'PagesController@getContact')->name('contact');
Route::post('contact', 'PagesController@sendEmail')->name('send.email'); //route name for controller action
Route::get('{username}/profile', 'PagesController@getProfile')->name('profile');
Route::get('{username}/blog/{slug}', 'BlogController@getSingle')->name('blog.single')->where('slug', '[\w\d\-\_]+');
Route::get('/blog/{username?}', 'BlogController@getIndex')->name('blog.index');
Route::get('/blog/random', 'BlogController@getRandom')->name('blog.random');
Route::resources([
    'posts' => 'PostController'
    ]);
Route::middleware('auth')->group(function(){
    Route::resource('comments', 'CommentController')->except(['create', 'show']);
});

Route::resource('categories', 'CategoryController')->except(['create']);
Route::resource('tags', 'TagController')->except(['create']);

Route::prefix('admin')->group(function(){
    Route::get("/", 'AdminController@index');
    Route::get("/dashboard", 'AdminController@dashboard')->name('admin.dashboard');
    Route::resource("/users", 'UserController');
    Route::resource("/permissions", 'PermissionController');
    Route::resource("/roles", 'RoleController')->except('destroy');
});
Auth::routes(); //using artisan command php artisan make:auth sets up routing, controllers, views etc.

/* for some reason a get request isnt created for logout but just in case a user decides to type the website name/logout we can:
    1. If he's a guest and accessing the page (for whatever reason) we can give a 404 error
    2. If he's logged in then log him or her out
*/
Route::get('logout', 'Auth\LoginController@logout', function () {
    return abort(404);
});
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/likes', 'LikeController@store');
Route::delete('/likes', 'LikeController@delete');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/portfolio', 'PagesController@portfolio')->name('portfolio');