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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'UserController@index');
Route::post('/userdata', 'UserController@userdata');
Route::get('/edit-users/{id}', 'UserController@edituser');
Route::get('/delete-users/{id}', 'UserController@deleteuser');
Route::post('/update-user', 'UserController@updateuser');