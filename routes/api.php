<?php

use App\Http\Controllers\AthleteController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\RegattaController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamTypeController;
use App\Http\Controllers\VenueController;
use Illuminate\Support\Facades\Route;

Route::apiResource('team-types', TeamTypeController::class);
Route::apiResource('teams', TeamController::class);
Route::apiResource('genders', GenderController::class);
Route::apiResource('athletes', AthleteController::class);
Route::apiResource('venues', VenueController::class);
Route::apiResource('regattas', RegattaController::class);
