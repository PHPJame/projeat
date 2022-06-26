<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admins', 'UserController@index')->name('admins');
Route::get('/', 'CardSlideController@index')->name('index');
Route::get('/index', 'CardSlideController@index')->name('index');
Route::get('topic-page/{id}', 'CardSlideController@topic_page')->name('topic_page', 'topic_page');
Route::resource('usermanage', 'AdminsUsersController')->name('index', 'usermanage');
Route::resource('cousesmanage', 'CousesController')->name('index', 'cousesmanage');
Route::resource('topicmanage', 'TopicController')->name('index', 'topicmanage');
Route::resource('lessonsmanage', 'LessonController')->name('index', 'lessonsmanage');
Route::get('indexlesson', 'TopicController@indexlesson')->name('index', 'indexlesson');
Route::resource('lessonsfilevideo', 'LessonFileVideoController')->name('index', 'lessonsfilevideo');