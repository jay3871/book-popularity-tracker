<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Novirza sākuma lapu uz grāmatu sarakstu
Route::redirect('/', '/books');

// Grāmatu saraksts ar meklēšanu, kārtošanu, popularitāti u.c.
Route::get('/books', [BookController::class, 'index'])->name('books.index');

// Poga "Pirkt" – grāmatas pirkšanas simulācija
Route::post('/books/{book}/purchase', [BookController::class, 'purchase'])->name('books.purchase');