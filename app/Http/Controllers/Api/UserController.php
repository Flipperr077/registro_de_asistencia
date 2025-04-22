<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Permite guardar un nuevo usuario.
     * Se usa para el registro de usuarios desde la app Python.
     */
    public function store(Request $request) {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'dni' => 'required|unique:users,dni|numeric|min:1|max:99999999',
            'email' => 'required|email|unique:users,email',
        ]);

        // Crear el nuevo usuario
        $user = User::create([
            'name' => $validatedData['name'],
            'lastname' => $validatedData['lastname'],
            'dni' => $validatedData['dni'],
            'email' => $validatedData['email'],
            'password' => bcrypt('123456'), // Contraseña por defecto, el usuario puede cambiarla después
        ]);

        return response()->json([
            'message' => 'Usuario creado exitosamente',
            'user' => $user,
        ], 201);
    }

    /**
     * Devuelve todos los usuarios.
     * Se usa para la vista de usuarios en la app Python.
     */
    public function index()
    {
        // Obtener todos los usuarios
        $users = User::all();

        return response()->json([
            'users' => $users,
        ], 200);
    }
}
