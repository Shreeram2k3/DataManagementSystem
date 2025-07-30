<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

//user routes
Route::middleware(['auth','verified'])->group(function(){
    Route::get('/dashboard',[UserController::class,'getdashboard'])->name('dashboard');
    Route::get('/studentactivity',[UserController::class,'showstudentactivity'])->name('studentactivity');
    Route::get('/facultyactivity',[UserController::class,'showfacultyactivity'])->name('facultyactivity');
    Route::get('/departmentactivity',[UserController::class,'showdepartmentactivity'])->name('departmentactivity');



});

//admin routes
Route::middleware(['auth',AdminMiddleware::class])->group(function(){
     Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});








Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

require __DIR__.'/auth.php';




