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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



//birth
Route::get('/birth-service','Helper\HelperController@filterRequest');


Route::get('/birth-service-filterOldToNew','Helper\HelperController@filterOldToNew');
Route::get('/birth-service-duplicate','Helper\HelperController@filterDuplicateRequest');

Route::get('/birth-service-search','Helper\HelperController@filterSearchRequest');
Route::get('/birth-service-verification','Helper\HelperController@filterVerificationRequest');
Route::get('/birth-service-correction','Helper\HelperController@filteCorrectionRequest');


//death
Route::get('/death-service','Helper\HelperController@deathFilterRequest');


Route::get('/death-service-filterOldToNew','Helper\HelperController@deathFilterOldToNew');
Route::get('/death-service-duplicate','Helper\HelperController@deathFilterDuplicateRequest');

Route::get('/death-service-search','Helper\HelperController@deathFilterSearchRequest');
Route::get('/death-service-verification','Helper\HelperController@deathFilterVerificationRequest');
Route::get('/death-service-correction','Helper\HelperController@deathFilteCorrectionRequest');


