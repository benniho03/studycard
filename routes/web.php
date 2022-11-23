<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;
use App\Http\Controllers\SetController;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [CardController::class, "startWelcomePage"])->middleware(['auth', 'verified'])->name('/');

Route::get('/create-card', [CardController::class, "getCardsData"])->middleware(['auth', 'verified']);

Route::post('/create-card', [CardController::class, "createCard"])->name('create-card');

Route::get('/edit-card/{id}', [CardController::class, "editCard"])->middleware(['auth', 'verified']);

Route::post('/update-card', [CardController::class, "updateCard"])->middleware(['auth', 'verified'])->name('update-card');

Route::get('/delete-card/{id}', [CardController::class, "deleteCard"])->middleware(['auth', 'verified']);

// Sets

Route::get('/create-set', [SetController::class, "showSets"])->middleware(['auth', 'verified']);

Route::post('/create-set', [SetController::class, "createSet"])->middleware(['auth', 'verified'])->name('create-set');

Route::get('/edit-set/{id}', [SetController::class, "editSet"])->middleware(['auth', 'verified']);

Route::post('/update-set', [SetController::class, "updateSet"])->middleware(['auth', 'verified']);

Route::get('/delete-set/{id}', [SetController::class, "deleteSet"])->middleware(['auth', 'verified']);

//AJAX

Route::get("fetch-cards", [CardController::class, "fetchCards"])->middleware(['auth', 'verified']);

Route::post('increment-step', [CardController::class, "incrementStep"])->name('increment-step')->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';