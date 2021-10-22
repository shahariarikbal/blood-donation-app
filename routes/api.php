<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/donor/registration', 'Frontend\FrontendController@registration');
Route::get('/get/search/data', 'Frontend\FrontendController@blood_donors');
Route::get('/get/donor-data/{id}', 'Frontend\FrontendController@blood_donor_details');
