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
    
    Route::get('/location-master', [HomeController::class, 'locationMaster']);
    Route::post('/location-master-add', [HomeController::class, 'locationMasterAdd']);
    Route::post('/location-master-edit', [HomeController::class, 'locationMasterEdit']);
    Route::post('/location-master-delete', [HomeController::class, 'locationMasterDelete']);
    
    Route::get('/project-master', [HomeController::class, 'projectMaster']);
    Route::post('/project-master-add', [HomeController::class, 'projectMasterAdd']);
    Route::post('/project-master-edit', [HomeController::class, 'projectMasterEdit']);
    Route::post('/project-master-delete', [HomeController::class, 'projectMasterDelete']);
    
    Route::get('/user-management', [HomeController::class, 'userManagement']);
    Route::post('/user-management-add', [HomeController::class, 'userManagementAdd']);
    Route::post('/user-management-edit', [HomeController::class, 'userManagementEdit']);
    Route::post('/user-management-delete', [HomeController::class, 'userManagementDelete']);

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

Route::post('/create-jsa', [HomeController::class, 'createJSA']);
Route::post('/edit-jsa', [HomeController::class, 'UpdateJSA']);
Route::post('/edit-status-review-jsa', [HomeController::class, 'UpdateStatusReviewJSA']);
Route::post('/delete-jsa', [HomeController::class, 'deleteJSA']);

Route::get('/user-penyusun-jsa/{id}', [HomeController::class, 'userPenyusunJsa']);
Route::get('/user-pelaksana-jsa/{id}', [HomeController::class, 'userPelaksanaJsa']);

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

Route::get('/PertimbanganLKJSA/{id}', [HomeController::class, 'PertimbanganLKJSA']);
Route::get('/PertimbanganPBJSA/{id}', [HomeController::class, 'PertimbanganPBJSA']);
Route::get('/PertimbanganPPEJSA/{id}', [HomeController::class, 'PertimbanganPPEJSA']);
Route::get('/PertimbanganPersonJSA/{id}', [HomeController::class, 'PertimbanganPersonJSA']);
Route::get('/statusJHA/{id}', [HomeController::class, 'statusJHA']);