<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\PopulationController;

Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/populations', [PopulationController::class, 'index'])->name('charts1');
    Route::post('/populations', [PopulationController::class, 'store'])->name('populations.store');
    Route::get('/populations/{id}/edit', [PopulationController::class, 'edit'])->name('populations.edit');
    Route::put('/populations/{id}', [PopulationController::class, 'update'])->name('populations.update');
    Route::delete('/populations/{id}', [PopulationController::class, 'destroy'])->name('populations.destroy');

    Route::get('/pekerjaan', [PekerjaanController::class, 'index2'])->name('charts2');
    Route::post('/pekerjaan', [PekerjaanController::class, 'store'])->name('pekerjaan.store');
    Route::get('/pekerjaan/{id}/edit', [PekerjaanController::class, 'edit']);
    Route::put('/pekerjaan/{id}', [PekerjaanController::class, 'update'])->name('pekerjaan.update');
    Route::delete('/pekerjaan/{id}', [PekerjaanController::class, 'destroy'])->name('pekerjaan.destroy');

});


Route::get('/', [PopulationController::class, 'user'])->name('user1');
Route::get('/user2', [PekerjaanController::class, 'user'])->name('user2');
Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminAuthController::class, 'login']);
Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');


