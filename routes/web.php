<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VacanteController;
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
    return view('welcome');
});

// DASHBOARD
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// VACANTE
Route::controller(VacanteController::class)->prefix('vacante')->group(function () {
    Route::get('/', 'index')->name('vacantes.index');
    Route::get('/create', 'create')->name('vacantes.create');
    Route::get('{vacante:id}/edit', 'edit')->name('vacantes.edit');
    Route::get('{vacante:id}', 'show')->middleware(null)->name('vacantes.show');
})->middleware(['auth']);

// PERFIL
Route::controller(ProfileController::class)->group(function () {
    Route::get('/profile', 'edit')->name('profile.edit');
    Route::patch('/profile', 'update')->name('profile.update');
    Route::delete('/profile', 'destroy')->name('profile.destroy');
})->middleware(['auth']);

require __DIR__ . '/auth.php';
