<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\HouseholdController;
use App\Http\Controllers\InstallationController;
use App\Http\Controllers\PvgisController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/* GENERAL PAGE ROUTES */

/**
 * Route to Home Page
 */
Route::get('/', function () {
    return view('home');
})->name('home');

/* AUTHENTICATION/USER ROUTES */

/**
 * Route to Signup Page
 */
Route::get('/signup', [UserController::class, 'create'])->name('signup');

/**
 * Route to Register a new user
 */
Route::post('/register', [UserController::class, 'store'])->name('register');

/**
 * Route to show login page
 */
Route::get('/login', [AuthenticationController::class, 'showLoginPage'])->name('login');

/**
 * Route to process a login for a user
 */
Route::post('/login', [AuthenticationController::class, 'login'])->name('login.post');

/**
 * Route to log a user out
 */
Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');

/**
 * Route to show user details
 */
Route::get('/my-details', [UserController::class, 'show'])->name('my-details')->middleware('auth');

/* HOUSEHOLD ROUTES */

/**
 * Route to show user's household
 */
Route::get('/my-household', [HouseholdController::class, 'show'])->name('my-household')->middleware('auth');

/* INSTALLATION ROUTES */

/**
 * Route to show an installation
 */
Route::get('/my-installations/{installation}', [InstallationController::class, 'show'])->name('installations.show');

/**
 * Route to show installations
 */
Route::get('/my-installations', [InstallationController::class, 'index'])->name('my-installations')->middleware('auth');

/**
 * Route to register a new installation
 */
Route::post('/new-installation', [InstallationController::class, 'store'])->name('new-installation')->middleware('auth');

/**
 * Route to get PVGIS results
 */
Route::post('/pvgis-results', [PvgisController::class, 'getMonthlyProjection'])->name('pvgis.results')->middleware('auth');
