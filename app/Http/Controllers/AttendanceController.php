<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;

class AttendanceController extends Controller
{
    /**
     * Permite guardar la asistencia de un usuario.
     * Guarda la asistencia como PRESENTE.
     * Se usa para el registro rápido de asistencia de la página de inicio.
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
        $attendance->user_id = $user->id; // Asignar el ID del usuario
        $attendance->school_day_id = null; // Asignar el ID del día escolar si es necesario
        $attendance->date = now(); // Fecha actual
        $attendance->status = 'present';
        $attendance->save();

        // Redirigir a la vista de éxito o a donde desees
        return redirect()->route('welcome')->with(['attendance-status' => 'Asistencia registrada exitosamente.']);

    }
}
public function registrarDesdeOCR(Request $request)
{
    // Validar los datos recibidos del OCR
    $validated = $request->validate([
        'dni' => 'required|numeric',
        'nombre' => 'required|string',
        'apellido' => 'required|string',
    ]);

    // Buscar si ya existe el usuario
    $user = User::firstOrCreate(
        ['dni' => $validated['dni']],
        ['name' => $validated['nombre'], 'surname' => $validated['apellido']]
    );

    // Registrar asistencia
    $attendance = new Attendance();
    $attendance->user_id = $user->id;
    $attendance->school_day_id = null; // Podés adaptarlo si usás días escolares
    $attendance->date = now();
    $attendance->status = 'present';
    $attendance->save();

    return response()->json(['mensaje' => 'Asistencia registrada desde OCR'], 200);
}
