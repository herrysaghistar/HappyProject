<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HseController;
use App\Http\Controllers\KabengController;
use App\Http\Controllers\KaproController;
use App\Http\Controllers\SpvController;
use App\Http\Controllers\KaryawanController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Define routes with middleware for each permission
Route::middleware('can:admin')->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
});

Route::middleware('can:hse')->group(function () {
    Route::get('/hse', [HseController::class, 'index']);
});

Route::middleware('can:kabeng')->group(function () {
    Route::get('/kabeng', [KabengController::class, 'index']);
});

Route::middleware('can:kapro')->group(function () {
    Route::get('/kapro', [KaproController::class, 'index']);
});

Route::middleware('can:spv')->group(function () {
    Route::get('/spv', [SpvController::class, 'index']);
});

Route::middleware('can:karyawan')->group(function () {
    Route::get('/karyawan', [KaryawanController::class, 'index']);
});
