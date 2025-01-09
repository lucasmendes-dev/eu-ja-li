<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/books', function () {
//     return Inertia::render('Index');
// })->middleware(['auth', 'verified'])->name('books');

Route::get('/books', [BookController::class, 'index'])->middleware(['auth', 'verified'])->name('books');
Route::post('/books', [BookController::class, 'store'])->middleware(['auth', 'verified'])->name('books.store');
Route::get('/books/{id}/edit', [BookController::class, 'edit'])->middleware(['auth', 'verified'])->name('books.edit');
Route::delete('/books/{id}', [BookController::class, 'destroy'])->middleware(['auth', 'verified'])->name('books.destroy');

require __DIR__.'/auth.php';
