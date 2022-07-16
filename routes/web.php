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

//Controllo le rotto del backend:
Auth::routes();

Route::middleware('auth')
    ->namespace('Admin')
    ->prefix('admin')
    ->name('admin.')
    ->group( function(){
        Route::get('/', 'HomeController@index')->name('index');
        Route::resource('posts', 'PostController');
    });

//Qualsiasi altra rotta la gestisco in frontend con guest.home:
Route::get('{any?}', function(){    return view('guest.home');})->where('any','.*')->name('home');

