<x-guest-layout>
@section('title', 'Registro de Estudiantes')
<h1>Registro de Estudiantes</h1>
@if(session('success'))
<div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border-radius: 4px;">
{{ session('success') }}
</div>
@endif
<div class="form-container">
    <a href="{{ route('users.create') }}" style="text-decoration: none;">
        <button class="boton-agregar">Nuevo Estudiante</button>
    </a>
</div>
<table id="tablaEstudiantes">
    <thead>
        <tr>
            <th>N°</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>DNI</th>
            <th>Fecha y Hora</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $user->nombres }}</td>
            <td>{{ $user->apellidos }}</td>
            <td>{{ $user->dni }}</td>
            <td class="fecha-hora">{{ $user->created_at->format('d/m/Y H:i:s') }}</td>
            <td>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="action-button" onclick="return confirm('¿Estás seguro de eliminar este estudiante?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</x-guest-layout>