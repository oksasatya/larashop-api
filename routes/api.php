<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('nama',function(){
    return 'namaku,larahsop API';
});

Route::post('umur',function(){
    return 17;
});

Route::prefix('v1')->group(function(){
    Route::get('books',function(){

    });

    Route::get('categoires',function(){

    });
});

Route::middleware(['throttle:10,1','cors'])->group(function(){
    Route::get('buku/{judul}',[BookController::class,'cetak']);
});
