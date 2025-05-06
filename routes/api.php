<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\UserController;


Route::prefix('v1')->group(function () {
    /** ATTENDACE */
    Route::get('/attendance', [AttendanceController::class, 'getAttendance']); // Ruta para obtener asistencia general
    Route::post('/attendance/storePresent', [AttendanceController::class, 'storePresent'])->name('attendance.store-present');
    Route::post('/v1/attendance/ocr', [AttendanceController::class, 'registrarDesdeOCR']);

    /** USERS */
    Route::get('/users', [UserController::class, 'index']); // Ruta para obtener todos los usuarios
    Route::get('/users/{id}', [UserController::class, 'show']); // Ruta para obtener un usuario por ID
    Route::post('/users', [UserController::class, 'store']); // Ruta para crear un nuevo usuario
    Route::put('/users/{id}', [UserController::class, 'update']); // Ruta para actualizar un usuario
    Route::delete('/users/{id}', [UserController::class, 'destroy']); // Ruta para eliminar un usuario
});
