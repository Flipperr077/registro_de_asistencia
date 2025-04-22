<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;

class AttendanceController extends Controller
{
    /**
     * Permite guardar la asistencia de un usuario.
     * Guarda la asistencia como PRESENTE.
     * Se usa para el registro rápido desde la app Python.
     */
    public function storePresent(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'attendance_dni' => 'required|numeric|min:1|max:99999999',
        ]);

        // Obtener el usuario por su DNI
        $user = User::where('dni', $validatedData['attendance_dni'])->first();
        if (!$user) {
            return redirect()->route('welcome')->with(['attendance-status' => 'Usuario no encontrado.']);
        }

        // Crear la asistencia
        $attendance = new Attendance();
        $attendance->user_id = $user->id; 
        $attendance->school_day_id = null; // Asignar el ID del día escolar si es necesario
        $attendance->date = now(); // Fecha actual
        $attendance->status = 'present';
        $attendance->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Asistencia registrada exitosamente.',
        ], 201);
    }

    /**
     * Obtiene todas las asistencias.
     * Se usa para la app Python.
     */
    public function index() {
        // Obtener todas las asistencias
        $attendances = Attendance::all();

        return response()->json([
            'status' => 'success',
            'data' => $attendances,
        ], 200);
    }
}
