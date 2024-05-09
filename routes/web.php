<?php

use App\Livewire\Entries\EditEntry;
use App\Livewire\EventClasses\CreateEventClass;
use App\Livewire\EventClasses\EditEventClass;
use App\Livewire\EventClasses\ListEventClasses;
use App\Livewire\Events\AddEntry;
use App\Livewire\Events\CreateEvent;
use App\Livewire\Events\EditEvent;
use App\Livewire\Genders\CreateGender;
use App\Livewire\Genders\EditGender;
use App\Livewire\Genders\ListGenders;
use App\Livewire\Home;
use App\Livewire\Regattas\CreateRegatta;
use App\Livewire\Regattas\EditRegatta;
use App\Livewire\Regattas\ListRegattas;
use App\Livewire\Regattas\ViewRegatta;
use App\Livewire\Teams\CreateTeam;
use App\Livewire\Teams\EditTeam;
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

    Route::get('/genders', ListGenders::class)->name('genders.list');
    Route::get('/genders/create', CreateGender::class)->name('genders.create');
    Route::get('/genders/{gender}/edit', EditGender::class)->name('genders.edit');

    Route::get('/event-classes', ListEventClasses::class)->name('event-classes.list');
    Route::get('/event-classes/create', CreateEventClass::class)->name('event-classes.create');
    Route::get('/event-classes/{class}/edit', EditEventClass::class)->name('event-classes.edit');

    Route::get('/teams', ListTeams::class)->name('teams.list');
    Route::get('/teams/create', CreateTeam::class)->name('teams.create');
    Route::get('/teams/{team}/edit', EditTeam::class)->name('teams.edit');

    Route::get('/regattas', ListRegattas::class)->name('regattas.list');
    Route::get('/regattas/create', CreateRegatta::class)->name('regattas.create');
    Route::get('/regattas/{regatta}/edit', EditRegatta::class)->name('regattas.edit');
    Route::get('/regattas/{regatta}/view', ViewRegatta::class)->name('regattas.view');

    Route::get('/events/create', CreateEvent::class)->name('events.create');
    Route::get('/events/{event}/edit', EditEvent::class)->name('events.edit');
    Route::get('/events/{event}/add-entry', AddEntry::class)->name('events.add-entry');
    Route::get('/entries/{entry}/edit', EditEntry::class)->name('entries.edit');
});
