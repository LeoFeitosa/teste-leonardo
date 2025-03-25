<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\PlayersController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum', 'check.ability'])->group(function () {
    Route::apiResource('teams', TeamController::class);
    Route::apiResource('players', PlayersController::class);
    Route::apiResource('games', GamesController::class);
});
