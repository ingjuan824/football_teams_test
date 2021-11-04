<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\ClassificationController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;
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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

// -------------- MODULE TEAMS -----------------------------------
Route::group(['prefix' => 'teams'], function () {
    Route::get('/', [TeamController::class, 'index']);
    Route::post('store', [TeamController::class, 'store']);
});

Route::group(['prefix' => 'divisions'], function () {
    Route::get('/', [DivisionController::class, 'index']);
});

Route::group(['prefix' => 'cities'], function () {
    Route::get('/', [CityController::class, 'index']);
});

Route::group(['prefix' => 'players'], function () {
    Route::get('/', [PlayerController::class, 'index']);
    Route::post('store', [PlayerController::class, 'store']);
});

Route::group(['prefix' => 'games'], function () {
    Route::post('store', [GameController::class, 'store']);
});

Route::group(['prefix' => 'classification'], function () {
    Route::get('/', [ClassificationController::class, 'index']);
});
