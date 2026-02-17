<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::post('/book', [BookController::class, 'store']);
