<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BillController;
use App\Http\Controllers\Admin\BusLevyController;
use App\Http\Controllers\Admin\FeeController;
use App\Http\Controllers\Admin\GuardianController;
use App\Http\Controllers\Admin\ReceiptController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\UniformController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth','admin')->name('admin.')->prefix('admin')->group(function(){
    //routes related to the admin
    Route::get('/', [AdminController::class, 'index'])->name('index');
    //resource routes for student
    Route::resource('/students', StudentController::class);
    Route::resource('/fees', FeeController::class);
    Route::resource('/uniforms', UniformController::class);
    Route::resource('/guardians', GuardianController::class);
    Route::resource('/buslevies', BusLevyController::class);
    Route::resource('/bills', BillController::class);
    // Routes to create students receipts
    Route::get('/fees-receipts', [ReceiptController::class, 'showCreateFeesReceiptPage'])->name('fees-receipts');
    Route::post('/get-fees', [ReceiptController::class, 'getStudentFeesPayments'])->name('get-fees');
    Route::get('/uniforms-receipts', [ReceiptController::class, 'showCreateUniformsReceiptPage'])->name('uniforms-receipts');
    Route::post('/uniforms-receipt', [ReceiptController::class, 'getStudentUniformsPayments'])->name('uniforms-receipt');
    Route::get('/buslevies-receipts', [ReceiptController::class, 'showCreateBusLeviesReceiptPage'])->name('buslevies-receipts');
    Route::post('/buslevies-receipt', [ReceiptController::class, 'getStudentBusLeviesPayments'])->name('buslevies-receipt');
});


require __DIR__.'/auth.php';
