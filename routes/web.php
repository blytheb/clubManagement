<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamRosterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Auth Routes (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});
/*
|--------------------------------------------------------------------------
| Role-based Routes
|--------------------------------------------------------------------------
*/

// ADMIN ONLY
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/teams', [TeamController::class, 'index'])->name('teams.index');                        //list of all teams
    Route::get('/teams/create', [TeamController::class, 'create'])->name('teams.create');               //form to create a new team
    Route::get('/teams/{team}/edit', [TeamController::class, 'edit'])->name('teams.edit');              //form to edit current team
    Route::post('/teams', [TeamController::class, 'store'])->name('teams.store');                       //backend to save created team
    Route::put('/teams/{team}', [TeamController::class, 'update'])->name('teams.update');               //backend to update team
    Route::delete('/teams/{team}', [TeamController::class, 'destroy'])->name('teams.destroy');          //backend to delete team

    Route::get('/teams/{team}', [TeamRosterController::class, 'index'])->name('roster.index');          //list all users on roster
    Route::get('/teams/{team}/createPlayer', [TeamRosterController::class, 'createPlayer'])             //form to create a player to add to this roster
        ->name('roster.create');
    Route::post('/teams/{team}', [TeamRosterController::class, 'storePlayer'])->name('roster.storePlayer');

    // Route::delete('/teams/{team}/roster/remove/{user}', [TeamRosterController::class, 'removePlayer'])->name('teams.roster.remove');

});

// // PLAYER ONLY
// Route::middleware(['auth', 'role:player'])->group(function () {
//     Route::get('/seasons', [SeasonController::class, 'index'])->name('seasons.index');
// });

