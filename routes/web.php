<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SchoolDaysController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AttendanceController;

// Rutas para SchoolDays
Route::resource('school-days', SchoolDaysController::class);

// Ruta para el dashboard
Route::get('/dashboard', function(){
    return view('dashboard');
})->name('dashboard');

// Rutas para Users
Route::resource('users', UserController::class);

// Rutas para Attendance
Route::resource('attendance', AttendanceController::class);
Route::post('/attendance/storePresent', [AttendanceController::class, 'storePresent'])->name('attendance.store-present');

// Ruta principal que usa UserController
Route::get('/', [HomeController::class, 'welcome'])->name('welcome');

Route::get('/registro-estudiantes', [UserController::class, 'index'])->name('registro-estudiantes'); // Vista funcional
