<?php

use App\Http\Controllers\Api\Auth\LoginController;
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

Route::prefix('v1/')->name('api.')->group(function(){
	Route::middleware(['auth:api','check-headers-api'])->apiResource('reservations', \App\Http\Controllers\Api\ReservationController::class);
	Route::middleware(['auth:api','check-headers-api'])->apiResource('rooms',\App\Http\Controllers\Api\RoomController::class);
	Route::middleware(['auth:api','check-headers-api'])->apiResource('categories',\App\Http\Controllers\Api\CategoryController::class);

    Route::post('register', );
    Route::post('login', [LoginController::class,'passwordAuthentication']);
    Route::middleware('auth:api')->group(function () {
        Route::get('me', [LoginController::class,'me']);
        Route::post('logout', [LoginController::class,'logout']);
    });
});
