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

Route::get('/' , 'HomeController@index');

Route::get('category/{name}/{page}' , 'CategoryController@index');
Route::get('products/{name}/{page}' , 'CategoryController@products');

Route::get('product/{name}' , 'ViewProductController@index');

Route::get('/register' , 'AuthController@indexRegister');
Route::get('/login' , 'AuthController@indexLogin');

Route::post('/register/user' , 'AuthController@insert');
Route::post('/login/user' , 'AuthController@login');
Route::get('/logout' , 'AuthController@logout');


