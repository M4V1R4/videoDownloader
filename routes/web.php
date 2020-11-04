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
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



//Route::get('/descarga/{url,format}', 'ColasController@index')->name('descarga');

//Route::post('/store','UrlsController@store')->name('store');
Route::resource('urls','UrlsController');
Route::resource('cola','ColasController');

//Route::get('/', 'UrlsController@index')->name('index');