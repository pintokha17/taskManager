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

Route::group(['middleware' => 'auth'], function(){
    Route::resource('task', 'TaskController');

    Route::get('/tasks', 'TaskController@index')->name('task');
    Route::get('start/{id}', 'TaskController@start')->name('start');
    Route::get('pause/{id}', 'TaskController@pause')->name('pause');

    Route::get('reports/', 'ReportController@index')->name('report');

    Route::get('user', 'UserController@view')->name('profile.view');
    Route::get('user/edit', 'UserController@edit')->name('profile.edit');
    Route::post('user/save', 'UserController@save')->name('profile.save');
    Route::match(['get', 'post'],'user/password', 'UserController@password')->name('profile.changePassword');

    Route::match(['get', 'post'],'reports/', 'ReportController@index')->name('report');
});