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

Route::get('/', 'CourseController@index')->name('home');

Route::get('/profile','UserController@show')->name('profile')->middleware('auth');

Route::get('/profile/edit','UserController@edit')->name('profile_edit')->middleware(['auth','verified']);

Route::post('/profile/update_info','UserController@update_info')->name('profile_update_info')->middleware('auth');

Route::post('/profile/update_password','UserController@update_password')->name('profile_update_password')->middleware('auth');

Auth::routes(['verify' => true]);

//Route::get('/home', 'HomeController@index')->name('home');
