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


Auth::routes();

Route::get('/', 'UserController@index')->name('home');
Route::get('/apply', 'UserController@applyList')->name('apply');
Route::get('/winner', 'UserController@winner')->name('winner');
Route::post('/apply', 'UserController@randomString');

Route::patch('/users/{id}/apply', 'UserController@update')->name('update');
