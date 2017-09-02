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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/products', 'ProductsController');

// users route
Route::get(
    '/users',
    ['uses' => 'UsersController@index']
);

Route::get(
   '/users/{id}',
   ['uses' => 'UsersController@show']
);

Route::delete(
    '/users/{id}',
    ['uses' => 'UsersController@destroy']
);
