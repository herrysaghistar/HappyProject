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

Route::get('/logouts', function () {
    Auth::logout();
  	return redirect('/');
});

Auth::routes();
Route::get('/', [HomeController::class, 'index']);

Route::middleware('can:admin')->group(function () {
    Route::get('/ptw-admin', [AdminController::class, 'index']);
    Route::get('/jsa-admin', [AdminController::class, 'jsa']);
});

Route::middleware('can:hse')->group(function () {
    Route::get('/ptw-hse', [HseController::class, 'index']);
    Route::get('/jsa-hse', [HseController::class, 'jsa']);
});

Route::middleware('can:kabeng')->group(function () {
    Route::get('/ptw-kabeng', [KabengController::class, 'index']);
    Route::get('/jsa-kabeng', [KabengController::class, 'jsa']);
});

Route::middleware('can:kapro')->group(function () {
    Route::get('/ptw-kapro', [KaproController::class, 'index']);
    Route::get('/jsa-kapro', [KaproController::class, 'jsa']);
});

Route::middleware('can:spv')->group(function () {
    Route::get('/ptw-spv', [SpvController::class, 'index']);
    Route::get('/jsa-spv', [SpvController::class, 'jsa']);
});

Route::post('/create-ptw', [HomeController::class, 'create']);
Route::post('/edit-ptw', [HomeController::class, 'UpdatePtw']);
Route::post('/delete-ptw', [HomeController::class, 'deletePtw']);

Route::post('/acc', [HomeController::class, 'acc']);
Route::post('/reject', [HomeController::class, 'reject']);

Route::post('/mulai', [HomeController::class, 'mulai']);
Route::post('/hold', [HomeController::class, 'hold']);
Route::post('/done', [HomeController::class, 'done']);

Route::get('/download-pdf/{id}', [HomeController::class, 'download']);

Route::get('/input-detail-tambahan/{id}', [HomeController::class, 'InputDetailTambahan']);
Route::get('/input-apd/{id}', [HomeController::class, 'InputApd']);

Route::get('/detail-tambahan/{id}', [HomeController::class, 'DetailTambahan']);
Route::get('/apd/{id}', [HomeController::class, 'Apd']);