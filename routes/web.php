<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HseController;
use App\Http\Controllers\KabengController;
use App\Http\Controllers\KaproController;
use App\Http\Controllers\SpvController;


// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/database-info', function () {
    return config('database');
});
Auth::routes();
Route::get('/', [HomeController::class, 'index']);

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

Route::post('/acc', [HomeController::class, 'acc']);
Route::post('/reject', [HomeController::class, 'reject']);

Route::get('/download-pdf/{id}', [HomeController::class, 'download']);