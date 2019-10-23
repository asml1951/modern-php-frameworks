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


use Illuminate\Support\Facades\Route;

Route::get('/admin', 'AdminController@index')->middleware('checkadmin');
Route::get('/', 'WelcomeController@showLatestNews');
Route::get('/arch', 'ArchController@moveToArchive');
Route::get('test','TestController@index');
Route::get('/add-user-to-group', 'UserGroupController@addUserToGroup');
Route::get('/delete', 'UserGroupController@deleteExpiredUsers');




