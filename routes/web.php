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

Route::get('/', 'App\Http\Controllers\CustomerController@index')->name('customer.index');
//Nomeando por questões de simplicidade, mas sei que não é necessário

Route::resource('customer', 'App\Http\Controllers\CustomerController')->except('index', 'create');

Route::prefix('customer/{customer}/')->group(function () {
    Route::resource('contact', 'App\Http\Controllers\CustomerContactController');
});
