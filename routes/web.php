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

Route::post('/course/create' , 'CourseController@store')->name('course.store')->middleware(['auth','verified' ,'teacher']);

Route::get('/course/create' , 'CourseController@create')->name('course.create')->middleware(['auth','verified' ,'teacher']);

Route::get('/course/{id}' , 'CourseController@show')->name('course.show')->middleware(['auth','verified']);

Route::get('/course/edit/{id}' , 'CourseController@edit')->name('course.edit')->middleware(['auth','verified' , 'teacher']);

Route::post('/course/edit/{id}' , 'CourseController@update')->name('course.update')->middleware(['auth','verified' , 'teacher']);

Route::get('/course/delete/{id}' , 'CourseController@destroy')->name('course.delete')->middleware(['auth','verified' , 'teacher']);



/**----------------------------------------------------------------------------------------------------------------**/

Route::get('/lesson/{id}','LessonController@show')->name('lesson.show')->middleware(['auth','verified']);

Route::get('/lesson/{id}/complete','LessonController@complete')->name('lesson.complete')->middleware(['auth','verified']);

/**----------------------------------------------------------------------------------------------------------------**/

Route::get('/chapter/{id}/quiz','ChapterController@quiz')->name('chapter.quiz')->middleware(['auth','verified']);

Route::post('/chapter/{id}/quiz','ChapterController@quizSubmit')->name('chapter.quizSubmit')->middleware(['auth','verified']);

Route::get('/chapter/{id}/quiz/create','ChapterController@quizCreate')->name('chapter.quizCreate')->middleware(['auth','verified','teacher']);

Route::post('/proposition/add','ChapterController@propositionAdd')->name('proposition.add')->middleware(['auth','verified','teacher']);

Route::post('/question/add','ChapterController@questionAdd')->name('question.add')->middleware(['auth','verified','teacher']);

/**----------------------------------------------------------------------------------------------------------------**/

Route::get('/profile','UserController@show')->name('profile')->middleware('auth');

Route::get('/profile/edit','UserController@edit')->name('profile.edit')->middleware(['auth','verified']);

Route::post('/profile/update_info','UserController@update_info')->name('profile.update_info')->middleware(['auth','verified']);

Route::post('/profile/update_password','UserController@update_password')->name('profile.update_password')->middleware(['auth','verified']);

/**----------------------------------------------------------------------------------------------------------------**/

Route::get('/teacher' , 'TeacherController@index')->name('teacher.courses')->middleware(['auth' , 'verified' ,'teacher']) ; 


