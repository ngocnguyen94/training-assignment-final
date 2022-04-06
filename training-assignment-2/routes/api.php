<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ModuleController;

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

Route::get('program', 'App\Http\Controllers\Api\ProgramController@index');
Route::get('module/parent-module/{id}', 'App\Http\Controllers\Api\ModuleController@getParentModule');
Route::get('article', 'App\Http\Controllers\Api\ArticleController@index');