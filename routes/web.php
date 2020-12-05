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
    return view('welcome');
});

Route::get('test', function() {
    return 'Hello World';
});

Route::get('test_2', function() {
    return view('test', ['message' => 'Hello World1111!!']);
});

Route::get('/admin', 'DashboardController@index');

Route::get('/admin/category/create','CategoryController@create'); // menampilkan form
Route::post('/admin/category', 'CategoryController@store'); // save data
Route::get('/admin/category', 'CategoryController@index'); // show all data

Route::get('/admin/category/{id}', 'CategoryController@show'); // detail / show data
Route::get('/admin/category/{id}/edit', 'CategoryController@edit'); // form edit data
Route::put('/admin/category/{id}', 'CategoryController@update'); // update data
Route::delete('admin/category/{id}', 'CategoryController@destroy'); // delete data
