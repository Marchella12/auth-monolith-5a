<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Modules\Library\Controllers\AuthorController;
use Modules\Library\Controllers\BookController;

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

// Route modul Library (Tugas 5.1)
Route::middleware('auth')->group(function () {
    Route::resource('authors', AuthorController::class)->only(['index', 'create', 'store', 'destroy']);
    Route::resource('books', BookController::class)->only(['index', 'create', 'store']);
    Route::post('books/{book}/borrow', [BookController::class, 'borrow'])->name('books.borrow');
});

require __DIR__.'/auth.php';