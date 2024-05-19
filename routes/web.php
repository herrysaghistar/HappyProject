<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Define routes with middleware for each permission
Route::middleware('permission:admin')->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
});

Route::middleware('permission:hse')->group(function () {
    Route::get('/hse', [HseController::class, 'index']);
});

Route::middleware('permission:kabeng')->group(function () {
    Route::get('/kabeng', [KabengController::class, 'index']);
});

Route::middleware('permission:kapro')->group(function () {
    Route::get('/kapro', [KaproController::class, 'index']);
});

Route::middleware('permission:spv')->group(function () {
    Route::get('/spv', [SpvController::class, 'index']);
});

Route::middleware('permission:karyawan')->group(function () {
    Route::get('/karyawan', [KaryawanController::class, 'index']);
});
