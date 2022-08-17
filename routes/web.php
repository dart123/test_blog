<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PostController@index');

Route::get('/articles/my_posts', 'PostController@myPosts')->middleware('auth');

Route::resource('/articles', 'PostController');

Route::post('/add_comment', 'CommentController@store')->middleware(['auth']);
Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/users', 'UserController@index');

require __DIR__.'/auth.php';
