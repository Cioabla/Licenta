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

Route::get('/register', function () {
    return view('auth/register');
});

Route::post('/register/user' , 'AuthController@insert');


Route::get('product/{name}' , 'ViewProductController@index');