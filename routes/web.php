<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/**
 * Route to Home Page
 */
Route::get('/', function () {
    return view('home');
})->name('home');

/**
 * Route to Signup Page
 */
Route::get('/signup', function () {
    return view('signup');
})->name('signup');

/**
 * Route to Register
 */
Route::post('/register', [UserController::class, 'store'])->name('register');