<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UtilityController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\SocialMediaChallengeController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
// Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'auth'])->name('auth');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Routes for managing properties
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/properties', [PropertyController::class, 'index']);
    Route::get('/get-properties', [PropertyController::class, 'getProperties'])->name('properties.get');
    Route::get('/trc/properties/print/{id}', [PropertyController::class, 'printProperty'])->name('properties.print');
    Route::get('/users/{user}/properties', [PropertyController::class, 'userProperties'])->name('users.properties');
});

// Routes for managing Users
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/get-users', [UserController::class, 'getUsers'])->name('users.get');
    Route::get('/trc/users/print/{id}', [UserController::class, 'printUser'])->name('users.print');
    Route::post('/users/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');
});

// Routes for creating Utilities
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('utilities/datatable', [UtilityController::class, 'getUtilities'])->name('utilities.datatable');
    Route::resource('utilities', UtilityController::class);
});

// Routes for creating Providers
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('providers/datatable', [ProviderController::class, 'getProviders'])->name('providers.datatable');
    Route::resource('providers', ProviderController::class);
});

// Routes for creating companies
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('companies/datatable', [CompanyController::class, 'getCompanies'])->name('companies.getCompanies');
    Route::resource('companies', CompanyController::class);
});

// Routes for creating social-media-challenges
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('social-media-challenges/list', [SocialMediaChallengeController::class, 'getSocialMediaChallenges'])->name('social-media-challenges.list');
    Route::resource('social-media-challenges', SocialMediaChallengeController::class);
});

// Routes for creating Announcements
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('announcements/list', [AnnouncementController::class, 'getAnnouncements'])->name('announcements.list');
    Route::resource('announcements', AnnouncementController::class);
});

// Route::get('/clear-config', function () {
//     Artisan::call('config:clear');
//     Artisan::call('route:clear');
//     Artisan::call('cache:clear');
//     Artisan::call('view:clear');
//     return response()->json(['message' => 'All caches cleared!']);
// });
