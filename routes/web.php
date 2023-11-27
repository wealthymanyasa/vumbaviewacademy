<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BusLevyController;
use App\Http\Controllers\Admin\FeeController;
use App\Http\Controllers\Admin\ParentController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth','admin')->name('admin.')->prefix('admin')->group(function(){
    //routes related to the admin
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::resource('/students', StudentController::class);
    Route::resource('/fees', FeeController::class);
    Route::resource('/uniforms', UniformController::class);
    Route::resource('/parents', ParentController::class);
    Route::resource('/buslevies', BusLevyController::class);

});

require __DIR__.'/auth.php';
