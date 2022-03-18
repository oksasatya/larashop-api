<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
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

// header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
// header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Accept,charset,boundary,Content-Length');
// header('Access-Control-Allow-Origin: *');


Route::prefix('v1')->group(function () {
    //public
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    // category
    Route::get('categories/random/{count}', [CategoryController::class, 'random']);
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('categories/slug/{slug}', [CategoryController::class, 'slug']);
    // book
    Route::get('books/top/{count}', [BookController::class, 'top']);
    Route::get('books', [BookController::class, 'index']);
    //private
    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
    });
});



// Route::resource('categories', CategoryController::class);
