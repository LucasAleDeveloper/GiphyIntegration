<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GiphyApiController;
use App\Http\Controllers\UserController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Auth 
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    //User
    Route::post('saveFavourite', [UserController::class, 'saveFavouriteGif']);
    
    //Giphy API
    Route::get('findOne/{id}', [GiphyApiController::class, 'findOne']);
    Route::get('findAll', [GiphyApiController::class, 'findAll']);
});





