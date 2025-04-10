@extends('layouts.app')

@section('title', 'Registro de Estudiantes')

@section('content')
<div class="container">
    <h1>Registro de Estudiantes</h1>

    <div class="form-container">
        <div class="form-group">
            <label for="nombres">Nombres:</label>
            <div id="nombres-container" class="nombres-container">
                <input type="text" class="nombre-input" required>
            </div>
            <button type="button" class="boton-agregar" onclick="agregarNombreApellido('nombres')">+ Nombre</button>
            <div class="error-message" id="nombreError"></div>
        </div>

        <div class="form-group">
            <label for="apellidos">Apellidos:</label>
            <div id="apellidos-container" class="apellidos-container">
                <input type="text" class="apellido-input" required>
            </div>
            <button type="button" class="boton-agregar" onclick="agregarNombreApellido('apellidos')">+ Apellido</button>
            <div class="error-message" id="apellidoError"></div>
        </div>

        <div class="form-group">
            <label for="dni">DNI (8 números):</label>
            <input type="text" id="dni" required maxlength="8" 
                   onkeypress="return event.charCode >= 48 && event.charCode <= 57">
            <div class="error-message" id="dniError"></div>
        </div>

        <button onclick="agregarEstudiante()">Agregar</button>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->lastname }}</td>
                    <td>{{ $user->dni }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
