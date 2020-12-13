<?php

use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});

Route::get('login', 'LoginController@login')->name('login');

Route::post('login/process', 'LoginController@authenticate')->name('login.authenticate');

// Route::get('test', function() {
//     return 'Hello World';
// });

// Route::get('test_2', function() {
//     return view('test', ['message' => 'Hello World1111!!']);
// });


Route::group(['middleware' => 'auth'], function() {

    Route::get('/admin', 'DashboardController@index')->name('admin');

    Route::get('/admin/category/create','CategoryController@create'); // menampilkan form
    Route::post('/admin/category', 'CategoryController@store')->name('category.store'); // save data
    Route::get('/admin/category', 'CategoryController@index'); // show all data

    Route::get('/admin/category/{id}', 'CategoryController@show'); // detail / show data
    Route::get('/admin/category/{id}/edit', 'CategoryController@edit'); // form edit data
    Route::put('/admin/category/{id}', 'CategoryController@update'); // update data
    Route::delete('admin/category/{id}', 'CategoryController@destroy'); // delete data

    Route::resource('admin/products', 'ProductController'); // route product

    Route::get('admin/transactions/', 'TransactionsController@index');
    Route::get('admin/transactions/create', 'TransactionsController@create')->name('transactions.create');
    Route::post('admin/transactions/import', 'TransactionsController@import')->name('transactions.import');

    Route::get('logout', 'LoginController@logout')->name('logout');

});


