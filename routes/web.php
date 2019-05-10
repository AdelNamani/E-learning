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

Route::get('/course/{id}/edit' , 'CourseController@edit')->name('course.edit')->middleware(['auth','verified' , 'teacher']);

Route::patch('/course/{id}' , 'CourseController@update')->name('course.update')->middleware(['auth','verified' , 'teacher']);

Route::delete('/course/{id}' , 'CourseController@destroy')->name('course.delete')->middleware(['auth','verified' , 'teacher']);

Route::patch('/course/{id}/state' , 'CourseController@updateState')->name('course.updateState')->middleware(['auth','verified' , 'teacher']);

Route::post('/course/search','CourseController@search')->name('course.search');

/**----------------------------------------------------------------------------------------------------------------**/

Route::get('/course/{id}/chapters' , 'CourseController@chapters')->name('course.chapters')->middleware(['auth','verified' , 'teacher']);

Route::post('/course/{id}/chapter/add','ChapterController@store')->name('chapter.store')->middleware(['auth','verified' , 'teacher']);

Route::delete('/chapter/{id}' , 'ChapterController@destroy')->name('chapter.delete')->middleware(['auth','verified' , 'teacher']);


/**----------------------------------------------------------------------------------------------------------------**/
Route::get('/chapter/{id}/lessons','ChapterController@lessons')->name('chapter.lessons')->middleware(['auth','verified','teacher']);

Route::get('/lesson/{id}','LessonController@show')->name('lesson.show')->middleware(['auth','verified']);

Route::get('/lesson/{id}/complete','LessonController@complete')->name('lesson.complete')->middleware(['auth','verified']);

Route::post('/lesson/add','LessonController@store')->name('lesson.store')->middleware(['auth','verified','teacher']);

Route::post('/lesson/destroy','LessonController@destroy')->name('lesson.destroy')->middleware(['auth','verified','teacher']);

/**----------------------------------------------------------------------------------------------------------------**/

Route::get('/chapter/{id}/quiz','QuizController@quiz')->name('chapter.quiz')->middleware(['auth','verified']);

Route::post('/chapter/{id}/quiz','QuizController@quizSubmit')->name('chapter.quizSubmit')->middleware(['auth','verified']);

Route::get('/chapter/{id}/quiz/create','QuizController@quizCreate')->name('chapter.quizCreate')->middleware(['auth','verified','teacher']);

Route::post('/proposition/add','QuizController@propositionAdd')->name('proposition.add')->middleware(['auth','verified','teacher']);

Route::post('/question/add','QuizController@questionAdd')->name('question.add')->middleware(['auth','verified','teacher']);

Route::delete('/proposition/{id}','QuizController@propositionDelete')->name('proposition.delete')->middleware(['auth','verified','teacher']);

Route::delete('/question/{id}','QuizController@questionDelete')->name('question.delete')->middleware(['auth','verified','teacher']);

/**----------------------------------------------------------------------------------------------------------------**/

Route::get('/profile','UserController@show')->name('profile')->middleware('auth');

Route::get('/profile/edit','UserController@edit')->name('profile.edit')->middleware(['auth','verified']);

Route::post('/profile/update_info','UserController@update_info')->name('profile.update_info')->middleware(['auth','verified']);

Route::post('/profile/update_password','UserController@update_password')->name('profile.update_password')->middleware(['auth','verified']);

/**----------------------------------------------------------------------------------------------------------------**/

Route::get('/teacher' , 'TeacherController@index')->name('teacher.courses')->middleware(['auth' , 'verified' ,'teacher']) ; 
/**----------------------------------------------------------------------------------------------------------------**/

Route::get('/admin', 'AdminController@index')->name('admin.home')->middleware(['auth' , 'verified', 'admin']);

Route::get('/admin/users', 'AdminController@users')->name('admin.users')->middleware(['auth' , 'verified', 'admin']);

Route::get('/admin/courses', 'AdminController@courses')->name('admin.courses')->middleware(['auth' , 'verified', 'admin']);

Route::post('/admin/check', 'AdminController@check')->name('admin.check')->middleware(['auth' , 'verified', 'admin']);

