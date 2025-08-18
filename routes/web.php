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
use App\Http\Controllers\StudentsActivityController\SA_IVController;
use App\Http\Controllers\StudentsActivityController\SA_VController;
use App\Http\Controllers\StudentsActivityController\SA_VIController;
use App\Http\Controllers\StudentsActivityController\SA_VIIController;
use App\Http\Controllers\StudentsActivityController\SA_VIIIController;
use App\Http\Controllers\StudentsActivityController\SA_IXController;
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
            Route::post('/Students-Activity/SA_III/create',[SA_IIIController::class, 'store'])->name('SAIII_Store');
            // post SAIV route 
            Route::post('/Students-Activity/SA_IV/create',[SA_IVController::class, 'store'])->name('SAIV_Store');
            // post SAV route 
            Route::post('/Students-Activity/SA_V/create',[SA_VController::class, 'store'])->name('SAV_Store');
            // post SAVI route 
            Route::post('/Students-Activity/SA_VI/create',[SA_VIController::class, 'store'])->name('SAVI_Store');
            // post SAVII route 
            Route::post('/Students-Activity/SA_VII/create',[SA_VIIController::class, 'store'])->name('SAVII_Store');
            // post SAVIII route 
            Route::post('/Students-Activity/SA_VIII/create',[SA_VIIIController::class, 'store'])->name('SAVIII_Store');
            // post SAIX route 
            Route::post('/Students-Activity/SA_IX/create',[SA_IXController::class, 'store'])->name('SAIX_Store');
            
        // Routes for update table in SA
            // update SA_I
            Route::put('/Students-activity/SA_I/update/{id}',[SA_IController::class, 'update'])->name('SAI_update');
            
            // update SA_II
            Route::put('/student-activity/SA_II/update/{id}',[SA_IIController::class,'update'])->name('SAII_update');  

            // update SA_III
            Route::put('/student-activity/SA_III/update/{id}',[SA_IIIController::class,'update'])->name('SAIII_update');

            //update SA_IV  
            Route::put('/student-activity/SA_IVupdate/{id}',[SA_IVController::class,'update'])->name('SAIV_update');

            //update SA_V  
            Route::put('/student-activity/SA_V/update/{id}',[SA_VController::class,'update'])->name('SAV_update');

            //update SA_VI 
            Route::put('/student-activity/SA_VI/update/{id}',[SA_VIController::class,'update'])->name('SAVI_update');

            //update SA_VII  
            Route::put('/student-activity/SA_VII/update/{id}',[SA_VIIController::class,'update'])->name('SAVII_update');

            //update SA_VIII  
            Route::put('/student-activity/SA_VIII/update/{id}',[SA_VIIIController::class,'update'])->name('SAVIII_update');

            //update SA_IX
            Route::put('/student-activity/SA_IX/update/{id}',[SA_IXController::class,'update'])->name('SAIX_update');

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
        
        
       