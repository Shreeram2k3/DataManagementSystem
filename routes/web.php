<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentsActivityController\SA_IController;
use App\Http\Controllers\StudentsActivityController\SA_IIController;
use App\Http\Controllers\StudentsActivityController\SA_IIIController;
use App\Models\StudentsActivityModels\SA_I;
use Illuminate\Contracts\Cache\Store;

Route::get('/', function () {
    return view('auth.login');
});

//user routes
Route::middleware(['auth','verified'])->group(function(){
    // user/dashboard route 
    Route::get('/dashboard',[UserController::class,'getdashboard'])->name('dashboard');
    // user/studentactivity route
    Route::get('/studentactivity',[UserController::class,'showstudentactivity'])->name('studentactivity');
    // user/facultyactivity route
    Route::get('/facultyactivity',[UserController::class,'showfacultyactivity'])->name('facultyactivity');
    // user/departmentactivity route
    Route::get('/departmentactivity',[UserController::class,'showdepartmentactivity'])->name('departmentactivity');

    // post SAI route 
    Route::post('/Students-Activity/SA_I/create', [SA_IController::class, 'store'])->name('SAI_Store');
    // post SAII route 
    Route::post('/Students-Activity/SA_II/create', [SA_IIController::class, 'store'])->name('SAII_Store');
    // post SAIII route 
    Route::post('/Students-Activity/SA_III/crete',[SA_IIIController::class, 'store'])->name('SAIII_Store');



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


// dummy routes for testing tables 
Route::get('/Students-Activity/SA_I',function () {
    return view('StudentActivityViews.SA_I');
});
Route::get('/Students-Activity/SA_II', function () {
          return view('StudentActivityViews.SA_II');});

Route::get('/Students-Activity/SA_III', function () {
    return view('StudentActivityViews.SA_III');
});