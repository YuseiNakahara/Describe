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

Route::delete('describe/comment/{id}', ['as' => 'describe.deletecomment', 'uses' => 'DescribeController@deletecomment']);
Route::get('upload', ['as' => 'describe.upload', 'uses' => 'DescribeController@upload']);
Route::get('confirm', ['as' => 'describe.confirm', 'uses' => 'DescribeController@confirm']);
Route::get('mypage', ['as' => 'describe.mypage', 'uses' => 'DescribeController@mypage']);
Route::get('describe/comment', ['as' => 'describe.comment', 'uses' => 'DescribeController@comment']);
Route::resource('describe', 'DescribeController');
Route::resource('user', 'UserController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
