<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::middleware(['auth', 'role:admin'])->get('/admin', function () {
    return 'Halo Admin! Kamu berhasil masuk.';
})->name('admin.dashboard');
Route::middleware(['auth', 'role:editor'])->get('/editor', function () {
    return 'Halo Editor! Kamu berhasil masuk.';
})->name('editor.dashboard');

Route::middleware(['auth', 'role:user'])->get('/user', function () {
    return 'Halo User! Kamu berhasil masuk.';
})->name('user.dashboard');