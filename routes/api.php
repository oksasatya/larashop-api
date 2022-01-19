<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Resources\Book;
use App\Models\book as ModelsBook;
use Illuminate\Support\Facades\DB;
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

Route::prefix('v1')->group(function () {
    Route::get('books', [BookController::class, 'index']);
    Route::get('book/{id}', [BookController::class, 'view']); // <== tambahkan ini
    Route::get('book', [BookController::class, 'show']);
    Route::get('books/destroy', [BookController::class, 'destroy']);

    //user

    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
});


Route::resource('categories', CategoryController::class);
