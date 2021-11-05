<?php

use App\Http\Controllers\ClassificationController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;
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
Route::get('/', [TeamController::class, 'index']);
Route::group(['prefix' => 'teams'], function () {
    Route::get('/', [TeamController::class, 'index'])->name('teams.index');
    Route::post('store', [TeamController::class, 'store'])->name('teams.store');
});

Route::group(['prefix' => 'games'], function () {
    Route::get('/', [GameController::class, 'index'])->name('games.index');
    Route::post('store', [GameController::class, 'store'])->name('games.store');
});

Route::group(['prefix' => 'players'], function () {
    Route::get('/', [PlayerController::class, 'index'])->name('players.index');
    Route::post('store', [PlayerController::class, 'store'])->name('players.store');
});

Route::group(['prefix' => 'classification'], function () {
    Route::get('/', [ClassificationController::class, 'index'])->name('classification.index');
});