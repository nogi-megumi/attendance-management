<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminAttendanceController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\RestController;
use App\Http\Controllers\WorkController;

Route::prefix('/admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'create'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'store']);
    Route::post('/logout', [AdminLoginController::class, 'destroy']);

    Route::middleware('auth:admin')->group(function () {
        Route::get('/attendance/list', [AdminAttendanceController::class, 'index']);
    });
});

Route::post('/register', [RegisterController::class, 'store']);
Route::post('/login', [LoginController::class, 'store']);
Route::middleware(['auth:web'])->group(function () {
    Route::get('/', [WorkController::class, 'show'])->name('attendance.show');
    Route::post('/attendance', [WorkController::class, 'store']);
    Route::put('/attendance', [WorkController::class, 'update']);
    Route::post('/rest', [RestController::class, 'store']);
    Route::put('/rest', [RestController::class, 'update']);
    Route::get('/attendance/list',[AttendanceController::class,'index']);
    Route::get('/attendance/detail/{attendance}',[AttendanceController::class, 'show']);
});


// Route::middleware(['auth', 'admin'])->get('/admin', function () {
//     return view('time-stamp');
// });
