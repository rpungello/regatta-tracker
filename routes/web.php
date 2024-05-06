<?php

use App\Livewire\Home;
use App\Livewire\Teams\CreateTeam;
use App\Livewire\Teams\ListTeams;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});

// Require authentication
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', Home::class)->name('home');
    Route::get('/teams', ListTeams::class)->name('teams.list');
    Route::get('/teams/create', CreateTeam::class)->name('teams.create');
});
