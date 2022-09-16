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

Route::get('/', 'UserController@UserList')->name('user.list');
Route::get('userslist', 'UserController@UserList')->name('user.list');
Route::post('storeuser', 'UserController@storeUser')->name('user.store');
Route::any('deleteuser/{enc_id}', 'UserController@deleteUser')->name('user.delete');
