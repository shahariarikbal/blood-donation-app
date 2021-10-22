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

Route::get('config', function () {
    \Artisan::call('cache:clear');
    \Artisan::call('config:clear');
    \Artisan::call('route:clear');
    dd("All clear!");
});

Route::get('/logout', function () {
    session()->flush();
});

Route::get('site/shutdown', function(){
    return Artisan::call('down');
});

Route::get('site/live', function(){
    return Artisan::call('up');
});

Route::get('/', 'Frontend\FrontendController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('{any}', function () {
    return view('welcome');
})->where('any', '.*');
