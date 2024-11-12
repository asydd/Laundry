<?php

use App\Http\Controllers\membercontroller;
use App\Http\Controllers\outletcontroller;
use App\Http\Controllers\paketcontroller;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('outlet', outletcontroller::class)->middleware('auth');
Route::resource('paket', paketcontroller::class)->middleware('auth');
Route::resource('member', membercontroller::class)->middleware('auth');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
