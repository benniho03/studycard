<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;
use App\Http\Controllers\SetController;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Redis;

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

// Route::get('/', function () {
//     return view('home');
// })->middleware(['auth', 'verified'])->name('/');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [CardController::class, "startWelcomePage"])->middleware(['auth', 'verified'])->name('/');

Route::get('/create-card', [CardController::class, "getCardsData"]);

Route::post('/create-card', [CardController::class, "createCard"])->name('create-card');

Route::get('/edit-card/{id}', [CardController::class, "editCard"]);

Route::post('/update-card', [CardController::class, "updateCard"])->name('update-card');

Route::get('/delete-card/{id}', [CardController::class, "deleteCard"]);

// Sets

Route::get('/create-set', [SetController::class, "showSets"]);

Route::post('/create-set', [SetController::class, "createSet"])->name('create-set');

Route::get('/edit-set/{id}', [SetController::class, "editSet"]);

Route::post('/update-set', [SetController::class, "updateSet"]);

Route::get('/delete-set/{id}', [SetController::class, "deleteSet"]);

//AJAX

Route::get("fetch-cards", [CardController::class, "fetchCards"]);


require __DIR__.'/auth.php';