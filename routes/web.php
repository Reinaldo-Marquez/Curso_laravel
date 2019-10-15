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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'HOLA REINALDO!!! ';
});

Route::get('/usuarios', 'UserController@index')->name('user');

Route::get('/usuarios/{user}', 'UserController@show')->where('user', '\d+')->name('show');

Route::put('/usuarios/{user}', 'UserController@update')->name('update');

Route::get('/usuarios/nuevo', 'UserController@create')->name('create');

Route::post('/usuarios', 'UserController@store')->name('store');

Route::get('/usuarios/{user}/editar', 'UserController@edit')->name('edit');

