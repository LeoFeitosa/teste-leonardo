<?php

use App\Http\Controllers\GamesController;
use App\Http\Controllers\PlayersController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::apiResource('teams', TeamController::class);
Route::apiResource('players', PlayersController::class);
Route::apiResource('games', GamesController::class);
