<?php

use App\Http\Controllers\Api\BookApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/books/top10', [BookApiController::class, 'top10']);