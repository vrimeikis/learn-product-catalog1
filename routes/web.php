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

Route::get('/', function() {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function() {
    Route::get('/', 'Admin\\HomeController@index')->name('home');

    Route::resource('category', 'Admin\\CategoryController')->except(['show', 'destroy']);
    Route::resource('products','Admin\\ProductController')->except(['show', 'destroy']);
    Route::resource('user', 'Admin\\UserController')->except(['show','destroy']);
});

