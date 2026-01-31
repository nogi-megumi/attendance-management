<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminAttendanceController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\RestController;
use App\Http\Controllers\StampCorrectRequestController;
use App\Http\Controllers\WorkController;

Route::prefix('/admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'create'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'store']);
    Route::post('/logout', [AdminLoginController::class, 'destroy']);
    Route::middleware('auth:admin')->group(function () {
        Route::get('/attendance/list', [AdminAttendanceController::class, 'index'])->name('admin.attendance.index');
        Route::get('/staff/list', [AdminAttendanceController::class, 'staffIndex']);
        Route::get('/attendance/staff/{user}', [AttendanceController::class, 'index']);
        Route::get('/attendance/detail/{attendance}', [AttendanceController::class, 'show']);
    });
});

Route::post('/register', [RegisterController::class, 'store']);
Route::post('/login', [LoginController::class, 'store']);
Route::middleware(['auth'])->group(function () {
    Route::get('/', [WorkController::class, 'show'])->name('attendance.show');
    Route::post('/attendance', [WorkController::class, 'store']);
    Route::put('/attendance', [WorkController::class, 'update']);
    Route::post('/rest', [RestController::class, 'store']);
    Route::put('/rest', [RestController::class, 'update']);
    Route::get('/attendance/list', [AttendanceController::class, 'index']);
    Route::get('/attendance/detail/{attendance}', [AttendanceController::class, 'show']);
    Route::post('/stamp_correction_request', [StampCorrectRequestController::class, 'store']);
    Route::get('/stamp_correction_request/list', [StampCorrectRequestController::class, 'index']);
    Route::get('/stamp_correction_request/approve/{correct_request}', [StampCorrectRequestController::class, 'show'])->name('admin.approve');
    Route::post('/stamp_correction_request/approve/{correct_request}', [StampCorrectRequestController::class, 'approve']);
});
