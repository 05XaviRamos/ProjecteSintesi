<?php

use App\Http\Controllers\ContainersController;
use App\Http\Controllers\MaterialsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecordsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('containers', ContainersController::class);
Route::resource('materials', MaterialsController::class);
Route::resource('records', RecordsController::class);

require __DIR__.'/auth.php';
