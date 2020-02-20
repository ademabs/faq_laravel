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
Route::get('/faq/questions/with_tag', 'FaqController@allWithTags')->name('questions.with_tags');

Route::get('/faq/tags', 'TagController@index')->name('tags.index');
Route::get('/faq/tag/{id}', 'TagController@get')->name('tag.get');
Route::post('/faq/tag/create', 'TagController@create')->name('tag.create');
Route::put('/faq/tag/{id}/update', 'TagController@update')->name('tag.update');
Route::delete('/faq/tag/{id}/delete', 'TagController@softDelete')->name('tag.softDelete');
Route::get('/faq/tags/with_faqs', 'TagController@allWithFaqs')->name('tags.with_faqs');

Route::get('/faq/categories/with_faq_tag', 'CategoryController@allWithQuestions')->name('categories.with_faq_tag');
