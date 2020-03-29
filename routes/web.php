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
})->name('home');

Route::get('/crud', 'ProjectController@index')->name('crudList');
Route::get('/crud/create', 'ProjectController@create')->name('crudAdd');
Route::post('/crud/create/new', 'ProjectController@store')->name('crudNew');
Route::get('/crud/show/{project}', 'ProjectController@show')->name('crudShow');
Route::get('/crud/edit/{project}', 'ProjectController@edit')->name('crudEdit');
Route::patch('/crud/edit/{project}/update','ProjectController@update')->name('crudUpdate');
Route::delete('/crud/destroy/{project}', 'ProjectController@destroy')->name('crudDestroy');

Route::get('/facebook', 'FacebookController@displayMe')->name('facebookMe');
