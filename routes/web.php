<?php

use App\Http\Controllers\ContainerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecordsController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkerRecordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('/statistics', [StatisticsController::class, 'index'])
    ->middleware(['auth'])
    ->name('statistics.index');

Route::get('/worker/zone-selector', [ZoneController::class, 'selector'])
    ->middleware(['auth'])
    ->name('worker.zone-selector');

Route::get('/worker/send-record/{zone?}', [WorkerRecordController::class, 'create'])
    ->middleware(['auth'])
    ->name('worker.send-record');

Route::post('/worker/send-record', [WorkerRecordController::class, 'store'])
    ->middleware(['auth'])
    ->name('worker.send-record.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::redirect('/admin/zone-management', '/zones');
    Route::redirect('/admin/material-management', '/materials');
    Route::redirect('/admin/container-management', '/containers');
    Route::redirect('/admin/users-management', '/users');
    Route::redirect('/admin/users-managment', '/users');
    Route::resource('zones', ZoneController::class)->except('show');
    Route::resource('materials', MaterialController::class)->except('show');
    Route::resource('containers', ContainerController::class)->except('show');
    Route::resource('users', UserController::class)->except('show');
});

Route::resource('records', RecordsController::class);

require __DIR__.'/auth.php';
