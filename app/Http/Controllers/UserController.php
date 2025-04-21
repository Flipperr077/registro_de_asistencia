<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Permite guardar un nuevo usuario.
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

        // Redirigir a la vista de éxito o a donde desees
        return redirect()->route('welcome')->with(['user-status' => 'Usuario creado exitosamente.']);
    }
}
