<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolDaysController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\UpdateAttendanceController;

// Rutas para SchoolDays
Route::resource('school-days', SchoolDaysController::class);

// Ruta para el dashboard
Route::get('/dashboard', function(){
    return view('dashboard');
})->name('dashboard');

// Rutas para Users
Route::resource('users', UserController::class);
Route::post('/users', [UserController::class, 'store'])->name('users.store');

// Rutas para Attendance
Route::resource('attendance', AttendanceController::class);

// Ruta principal que usa UserController
Route::get('/', [SchoolDaysController::class, 'index'])->name('welcome');

Route::get('/registro-estudiantes', [UserController::class, 'index'])->name('registro_estudiantes'); // Vista funcional


