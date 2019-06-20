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

Route::get('list', ['as' => 'describe.list', 'uses' => 'DescribeController@list']);
Route::resource('describe', 'DescribeController');
Route::resource('user', 'UserController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
