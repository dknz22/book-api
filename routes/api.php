<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;

Route::get('/books/search', [BookController::class, 'search']);
Route::apiResource('books', BookController::class);
Route::apiResource('authors', AuthorController::class);