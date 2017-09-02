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
Route::get('/products', 'ProductsController@index')->name('products');
Route::get(
       '/products/{id}',
       ['uses' => 'ProductsController@show']
   );
Route::post(
       '/products',
       ['uses' => 'ProductsController@store']
   );
Route::post(
   '/products/{id}',
   ['uses' => 'ProductsController@update']
);
Route::delete(
    '/products/{id}',
    ['uses' => 'ProductsController@destroy']
);

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
