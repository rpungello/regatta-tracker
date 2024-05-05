<?php

use App\Http\Controllers\TeamTypeController;
use Illuminate\Support\Facades\Route;

Route::apiResource('team-types', TeamTypeController::class);
