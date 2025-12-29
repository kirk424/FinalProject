<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\BorrowerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

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

 Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Books CRUD
    Route::resource('books', BookController::class);

    // Borrowers CRUD
    Route::resource('borrowers', BorrowerController::class);

    // Borrow / Return
    Route::get('/borrows', [BorrowController::class, 'index'])
        ->name('borrows.index');

    Route::post('/borrows', [BorrowController::class, 'store'])
        ->name('borrows.store');

    Route::post('/borrows/{borrow}/return', [BorrowController::class, 'return'])
        ->name('borrows.return');
});

require __DIR__.'/auth.php';
