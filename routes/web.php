<?php

Route::get('/modelo', function () {
    return view('welcome');
});

Auth::routes();

Route::namespace('Site')->group(function () {
    Route::get('/', 'PrincipalController@index')->name('principal');
});

Route::middleware('auth')->namespace('Admin')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
});

Route::prefix('admin')->middleware('auth')->namespace('Admin')->group(function () {
    Route::resource('/users', 'UserController');
    Route::resource('/betting', 'BettingController');
});

Route::prefix('admin')->middleware(['auth','can:acl'])->namespace('Admin')->group(function () {
    Route::resource('/permission', 'PermissionController');
    Route::resource('/roles', 'RoleController');
});
