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

Auth::routes(['verify' => true]);

/**----------------------------------------------------------------------------------------------------------------**/

Route::get('/', 'CourseController@index')->name('home');

Route::get('/course/{id}' , 'CourseController@show')->name('course.show')->middleware('auth');

/**----------------------------------------------------------------------------------------------------------------**/

Route::get('/lesson/{id}','LessonController@show')->name('lesson.show');

Route::get('/lesson/{id}/complete','LessonController@complete')->name('lesson.complete');

/**----------------------------------------------------------------------------------------------------------------**/

Route::get('/chapter/{id}/quiz','ChapterController@quiz')->name('chapter.quiz');

/**----------------------------------------------------------------------------------------------------------------**/

Route::get('/profile','UserController@show')->name('profile')->middleware('auth');

Route::get('/profile/edit','UserController@edit')->name('profile.edit')->middleware(['auth']);

Route::post('/profile/update_info','UserController@update_info')->name('profile.update_info')->middleware('auth');

Route::post('/profile/update_password','UserController@update_password')->name('profile.update_password')->middleware('auth');

/**----------------------------------------------------------------------------------------------------------------**/



