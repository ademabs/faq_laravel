<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use Illuminate\Http\Request;

Route::get('/'.config('app.url_base_path'), 'IndexController@index')->name('index');

Route::get('/faq/categories', 'CategoryController@index')->name('categories.index');
Route::get('/faq/category/{id}', 'CategoryController@get')->name('category.get');
Route::post('/faq/category/create', 'CategoryController@create')->name('category.create');
Route::put('/faq/category/{id}/update', 'CategoryController@update')->name('category.update');
Route::delete('/faq/category/{id}/delete', 'CategoryController@delete')->name('category.delete');

Route::get('/faq/questions', 'FaqController@index')->name('faqs.index');
Route::get('/faq/question/{id}', 'FaqController@get')->name('question.get');
Route::post('/faq/question/create', 'FaqController@create')->name('question.create');
Route::put('/faq/question/{id}/update', 'FaqController@update')->name('question.update');
Route::delete('/faq/question/{id}/delete', 'FaqController@delete')->name('question.delete');
