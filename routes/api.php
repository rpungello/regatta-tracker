<?php

use App\Http\Controllers\AthleteController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamTypeController;
use Illuminate\Support\Facades\Route;

Route::apiResource('team-types', TeamTypeController::class);
Route::apiResource('teams', TeamController::class);
Route::apiResource('genders', GenderController::class);
Route::apiResource('athletes', AthleteController::class);
