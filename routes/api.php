<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Log;

/*
Ruta para obtener todos los usuarios
Route::get('/users', function () {
    $servidor = "localhost";
    $usuario = "root";
    $contraseña = ""; // tu contraseña de MySQL, si tenés
    $baseDeDatos = "asistencia";

    $conn = new mysqli($servidor, $usuario, $contraseña, $baseDeDatos);

    if ($conn->connect_error) {
        return response()->json(["status" => "error", "message" => "Error de conexión: " . $conn->connect_error], 500);
    }

    $sql = "SELECT id, nombres, apellidos, dni, email FROM users";
    $result = $conn->query($sql);
    $users = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }

    $conn->close();
    return response()->json($users);
}); 

Ruta para obtener un usuario por ID
Route::get('/users/{id}', function ($id) {
    return "obtener estudiante con ID $id";
});

Ruta para crear un nuevo usuario
Route::post('/users', function (Request $request) {
    $servidor = "localhost";
    $usuario = "root";
    $contraseña = ""; // tu contraseña de MySQL
    $baseDeDatos = "asistencia";

    $conn = new mysqli($servidor, $usuario, $contraseña, $baseDeDatos);

    if ($conn->connect_error) {
        return response()->json(["status" => "error", "message" => "Error de conexión: " . $conn->connect_error], 500);
    }

    $nombres = $request->input('nombres');
    $apellidos = $request->input('apellidos');
    $dni = $request->input('dni');
    $email = $request->input('email'); // opcional

    if (!$nombres || !$apellidos || !$dni) {
        return response()->json(["status" => "error", "message" => "Faltan datos obligatorios"], 400);
    }

    $stmt = $conn->prepare("INSERT INTO users (nombres, apellidos, dni, email) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $nombres, $apellidos, $dni, $email);

    if ($stmt->execute()) {
        $response = ["status" => "success", "message" => "Usuario creado correctamente"];
    } else {
        $response = ["status" => "error", "message" => "Error al insertar usuario: " . $stmt->error];
    }

    $stmt->close();
    $conn->close();
    return response()->json($response);
});

Ruta para actualizar un usuario
Route::put('/users/{id}', function ($id) {
    return "actualizando estudiante con ID $id";
});

Ruta para eliminar un usuario
Route::delete('/users/{id}', function ($id) {
    return "eliminando estudiante con ID $id";
});
*/

/** ATTENDACE */
Route::post('/register-attendance', [AttendanceController::class, 'registerAttendance']); // Ruta para registrar asistencia
Route::get('/attendance', [AttendanceController::class, 'getAttendance']); // Ruta para obtener asistencia general
Route::get('/users/{id}/attendance', [UserController::class, 'getUserAttendance']); // Ruta para obtener asistencia de un usuario por ID

/** USERS */
Route::get('/users', [UserController::class, 'index']); // Ruta para obtener todos los usuarios
Route::get('/users/{id}', [UserController::class, 'show']); // Ruta para obtener un usuario por ID
Route::post('/users', [UserController::class, 'store']); // Ruta para crear un nuevo usuario
Route::put('/users/{id}', [UserController::class, 'update']); // Ruta para actualizar un usuario
Route::delete('/users/{id}', [UserController::class, 'destroy']); // Ruta para eliminar un usuario
