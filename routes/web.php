<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UtilityController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'auth'])->name('auth');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Routes for managing properties
Route::get('/properties', [PropertyController::class, 'index']);
Route::get('/get-properties', [PropertyController::class, 'getProperties'])->name('properties.get');

// Routes for managing Users
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/get-users', [UserController::class, 'getUsers'])->name('users.get');

// Routes for creating Utilities
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('utilities/datatable', [UtilityController::class, 'getUtilities'])->name('utilities.datatable');
    Route::resource('utilities', UtilityController::class);
});


// Route::middleware(['auth:sanctum', 'verified'])->group(function () {
//     Route::get('all/users', [All_Users_data_Controller::class, 'index'])->name('daily_reports.index');
//     Route::get('user/data', [All_Users_data_Controller::class, 'getData'])->name('daily_reports.data');
//     Route::get('user/add', [All_Users_data_Controller::class, 'add'])->name('daily_reports.add');
//     Route::post('user/store', [All_Users_data_Controller::class, 'store'])->name('daily_reports.store');
//     Route::get('user/show/{id}', [All_Users_data_Controller::class, 'show'])->name('daily_reports.show');
//     Route::post('user/update/{id}', [All_Users_data_Controller::class, 'update'])->name('daily_reports.update');
//     Route::get('user/destroy/{id}', [All_Users_data_Controller::class, 'destroy'])->name('daily_reports.destroy');
// });
