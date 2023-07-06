<?php

use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\PackController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->prefix('packs')->group(function () {
    Route::get('/', [PackController::class, 'index']);
    Route::get('/{id}', [PackController::class, 'show']);
    Route::post('/', [PackController::class, 'save']);
    Route::delete('/{id}', [PackController::class, 'delete']);
    Route::put('/{id}', [PackController::class, 'put']);
});

Route::namespace('Api')->prefix('images')->group(function () {
    Route::delete('/{id}', [ImageController::class, 'delete']);
});
