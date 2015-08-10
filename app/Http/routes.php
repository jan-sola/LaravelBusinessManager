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
Route::get('/manage', ['middleware' => ['auth', 'admin'], 'uses' => 'businessController@manageIndex']);
Route::post('/businesses/{id}/follow', 'businessController@follow');

//Business and user resources
Route::resource('businesses', 'BusinessController');
Route::resource('users', 'UsersController');

//API JSON business and user data
Route::get('api/businesses', 'BusinessController@getBusinesses');
Route::get('api/businesses/{id}', 'BusinessController@getBusiness');
Route::get('api/users', 'UsersController@getUsers');
Route::get('api/users/{id}', 'UsersController@getUser');

// Authentication routes
//Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes
//Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');