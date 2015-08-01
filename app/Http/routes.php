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

Route::get('/', 'businessController@index');

Route::get('/businesses/', 'businessController@index');
Route::get('/businesses/create', 'businessController@createBusinessView');
Route::get('/businesses/{id}', 'businessController@viewBusiness')->where('id', '[0-9]+');
Route::get('/businesses/{id}/edit', 'businessController@editBusiness')->where('id', '[0-9]+');;
Route::delete('/businesses/{id}', 'businessController@deleteBusiness')->where('id', '[0-9]+');;

Route::get('/users/create', 'businessController@createUserView');
Route::get('/users/{id}/edit', 'businessController@editUser')->where('id', '[0-9]+');
Route::delete('/users/{id}', 'businessController@deleteUser')->where('id', '[0-9]+');

Route::get('/manage', 'businessController@manageIndex');

Route::get('/api/businesses', 'businessController@getBusinesses');
Route::get('/api/businesses/{id}', 'businessController@getBusiness')->where('id', '[0-9]+');
Route::post('/api/businesses/create', 'businessController@createBusiness');

Route::get('/api/users', 'businessController@getUsers');
Route::post('/api/users/create', 'businessController@createUser');
Route::get('/api/users/{id}', 'businessController@getUser')->where('id', '[0-9]+');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');