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
//Route::get('/articles/{slug}', 'PostController@getSingle');

Route::get('/articles/my_posts', 'PostController@getPostsByUser')->middleware('auth');

Route::resource('/articles', 'PostController');
//Route::get('/articles/edit/{id}', 'PostController@edit');
//Route::post('/articles/new','PostController@add');
//Route::post('/articles/{id}', 'PostController@update');
//Route::delete('/articles/{id}', 'PostController@delete');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
