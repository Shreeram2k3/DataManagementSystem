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
use App\Http\Controllers\StudentsActivityController\SAdatapageController;
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

    // Routes for Storing data in SA 
            // post SAI route 
            Route::post('/Students-Activity/SA_I/create', [SA_IController::class, 'store'])->name('SAI_Store');
            // post SAII route 
            Route::post('/Students-Activity/SA_II/create', [SA_IIController::class, 'store'])->name('SAII_Store');
            // post SAIII route 
            Route::post('/Students-Activity/SA_III/crete',[SA_IIIController::class, 'store'])->name('SAIII_Store');
    
    // Routes for update table in SA
            // update SA_I
            Route::put('/Students-activity/update/{id}',[SA_IController::class, 'update'])->name('SAI_update');
            // update SA_II    
            Route::put('/student-activity/update/{id}',[SA_IIController::class,'update'])->name('SAII_update');
             // update SA_III    
            Route::put('/student-activity/update/{id}',[SA_IIIController::class,'update'])->name('SAIII_update');
//table view test route
    Route::get('/Student_Activity/view/{type}',[SAdatapageController::class, 'Select_form'])->name('SA.view');

});

//admin routes
Route::middleware(['auth',AdminMiddleware::class])->group(function(){
     Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::delete('/student-activity/delete/{type}/{id}', [SAdatapageController::class, 'destroy'])->name('student_activity_delete');









Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

require __DIR__.'/auth.php';
 
//401-page
Route::get('/unauthorized',function()
{
    return view('unauthorized');
})->name('unauthorized');

// dummy routes for testing tables 
// Route::get('/Students-Activity/SA_I',function () {
//     return view('StudentActivityViews.SA_I');
// });
// Route::get('/Students-Activity/SA_II', function () {
//           return view('StudentActivityViews.SA_II');});


Route::get('/student-activity/{type}/{id}/edit', [SAdatapageController::class, 'edit'])->name('student_activity_edit');
Route::put('/student-activity/{type}/{id}', [SAdatapageController::class, 'update'])->name('student_activity_update');

