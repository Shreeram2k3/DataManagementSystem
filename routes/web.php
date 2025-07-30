<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\StudentsActivityController\SA_IController;
use App\Http\Controllers\StudentsActivityController\SA_IIController;
use App\Http\Controllers\StudentsActivityController\SA_IIIController;
use App\Models\StudentsActivityModels\SA_I;
use Illuminate\Contracts\Cache\Store;

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
Route::get('/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

require __DIR__.'/auth.php';

// SA_IController.php
Route::post('/Students-Activity/SA_I/create', [SA_IController::class, 'store'])->name('SAI_Store');
Route::get('/Students-Activity/SA_I',function () {
    return view('StudentActivityViews.SA_I');
});
//create a route for SA_IIController
Route::post('/Students-Activity/SA_II/create', [SA_IIController::class, 'store'])->name('SAII_Store');
Route::get('/Students-Activity/SA_II', function () {
          return view('StudentActivityViews.SA_II');
});
//create a route for SA_IIIController
Route::post('/Students-Activity/SA_III/crete',[SA_IIIController::class, 'store'])->name('SAIII_Store');
Route::get('/Students-Activity/SA_III', function () {
    return view('StudentActivityViews.SA_III');
});