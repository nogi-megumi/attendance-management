<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AttendanceController;

Route::get(
    '/admin/login',
    function () {
        return view('auth.login');
    }
)->name('admin.login');
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/login', [LoginController::class, 'store']);
Route::middleware(['auth'])->get('/', function () {
    return view('time-stamp');
});
// Route::middleware(['auth', 'admin'])->get('/admin', function () {
//     return view('time-stamp');
// });
