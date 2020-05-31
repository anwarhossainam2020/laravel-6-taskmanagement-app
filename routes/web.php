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

Route::get('/', [
    'as' => 'home',
    'uses' => 'TasksController@index'
]);
Route::get('/task/create', 'TasksController@create');
Route::post('/task/store', 'TasksController@store');

Route::get('/task/edit/{id}', [
    'as' => 'task.edit',
    'uses' => 'TasksController@edit'
]);
Route::post('/task/update/{id}', [
    'as' => 'task.update',
    'uses' => 'TasksController@update'
]);
Route::delete('/task/destroy/{id}', [
    'as' => 'task.destroy', 
    'uses' => 'TasksController@destroy'
]);

Route::post('/task/update-sort-order', [
    'as' => 'task.updateSortOrder',
    'uses' => 'TasksController@updateSortOrder'
]);

// Route::get('/', function () {
//     return view('welcome');
// });
