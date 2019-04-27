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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->middleware('auth')->namespace('Admin')->group(function () {

    Route::resource('/users', 'UserController');
        Route::get('/users', 'UserController@index')->name('users.index')->middleware('can:list-user');
        Route::get('/users/create', 'UserController@create')->name('users.create')->middleware('can:create-users');
        Route::post('/users', 'UserController@store')->name('users.store')->middleware('can:create-users');
    Route::resource('/permission', 'PermissionController');
    Route::resource('/roles', 'RoleController');
});
