<?php


// Root
Route::get('/', 'RootController@index');

// 記事カスタマイズのrootはこちら
Route::get('/doc', 'RootController@doc');


// Login
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout');


//Route::get('/', function () {
//    return view('welcome');
//});
//
//Auth::routes();
//
// Route::get('/home', 'HomeController@index')->name('home');
