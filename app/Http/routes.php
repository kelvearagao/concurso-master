<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Resources
|--------------------------------------------------------------------------
|
*/

Route::post('question/create/option', 'QuestionController@createOption');
Route::delete('question/option/{id}', 'QuestionController@destroyOption');
Route::get('question/{id}/modal', 'QuestionController@showModal');
Route::get('question/{id}/option/{option_id}/answer', 'QuestionController@isAnswer');
Route::get('question/categories', 'QuestionController@getCategories');
Route::get('question/{id}/add/category/{name}', 'QuestionController@addCategory');
Route::delete('question/{id}/category/{name}', 'QuestionController@destroyQestionCategory');

Route::resource('question', 'QuestionController');
Route::resource('category', 'CategoryController');
