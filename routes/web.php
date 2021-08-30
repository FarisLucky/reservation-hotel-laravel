<?php

use Illuminate\Support\Facades\Auth;
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

Route::middleware('auth')
    ->get('/',[\App\Http\Controllers\HomeController::class,'index']);

Auth::routes();

Route::middleware('auth')->group(function (){
    Route::resource('rooms',\App\Http\Controllers\RoomController::class);
});
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

