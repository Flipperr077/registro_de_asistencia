<?php
$servidor = "localhost";
$nombres = "root";
$apellidos = "root";
$dni = "root";
$baseDeDatos = "asistencia";

$enlace = new mysqli($servidor, $nombres, "", "asistencia");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Asistencia de Estudiantes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f2f5;
        }
        .container {
            max-width: 1300px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
        }   
        h1, h2 {
            text-align: center;
            color: #1a73e8;
            margin-bottom: 30px;
        }
        .form-container {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 4px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #1a73e8;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover { opacity: 0.9; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
<form action="#" name="asistencia" method="post">
    <div class="container">
        <h1>Registro de Asistencia de Estudiantes</h1>

        <!-- Ingreso de DNI para asistencia -->
        <div class="form-container">
            <div class="form-group">
                <label for="dni">Ingresar DNI (8 números)</label>
                <input type="text" id="dni" maxlength="8" placeholder="DNI" required>
            </div>
            <button type="button" onclick="registrarAsistencia()">Registrar Asistencia</button>
        </div>

        <!-- Tabla de asistencia -->
        <h2>Historial de Asistencia</h2>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>DNI</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody id="cuerpoTabla"></tbody>
        </table>

        <!-- Usuarios Registrados -->
        <h2>Usuarios Registrados</h2>
        <button type="button" onclick="cargarUsuarios()">Ver Usuarios Registrados</button>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>DNI</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody id="cuerpoUsuarios"></tbody>
        </table>

        <!-- Formulario para Registrar Usuario -->
        <h2>Registrar Nuevo Usuario</h2>
        <div class="form-container">
            <div class="form-group">
                <label for="nombres">Nombre</label>
                <input type="text" id="nombres" placeholder="Nombre" required>
            </div>
            <div class="form-group">
                <label for="apellidos">Apellido</label>
                <input type="text" id="apellidos" placeholder="Apellido" required>
            </div>
            <div class="form-group">
                <label for="dniRegistro">DNI (8 números)</label>
                <input type="text" id="dniRegistro" maxlength="8" placeholder="DNI" required>
            </div>
            <button type="button" onclick="registrarUsuario()">Registrar Usuario</button>
        </div>
    </div>
</form>

<script>
    const API_BASE = '/api';

    async function registrarAsistencia() {
        const dni = document.getElementById('dni').value.trim();

        if (!dni || dni.length !== 8) {
            alert("El DNI debe tener 8 dígitos.");
            return;
        }

        try {
            const userCheck = await fetch(`${API_BASE}/users/dni/${dni}`);
            if (!userCheck.ok) {
                alert('El DNI no existe en la base de datos.');
                return;
            }

            const user = await userCheck.json();

            const asistenciaResponse = await fetch(`${API_BASE}/attendance`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    user_id: user.id,
                    status: 'presente',
                    date: new Date().toISOString().split('T')[0]
                }),
            });

            if (asistenciaResponse.ok) {
                alert(`Asistencia registrada para ${user.nombres} ${user.apellidos}.`);
            } else {
                throw new Error('Error al registrar la asistencia.');
            }
        } catch (error) {
            console.error('Error al registrar asistencia:', error);
            alert('Hubo un problema al registrar la asistencia.');
        }
    }

    async function registrarUsuario() {
        const nombres = document.getElementById('nombres').value.trim();
        const apellidos = document.getElementById('apellidos').value.trim();
        const dni = document.getElementById('dniRegistro').value.trim();

        if (!nombres || !apellidos || !dni || dni.length !== 8) {
            alert("Por favor, complete todos los campos correctamente.");
            return;
        }

        try {
            const response = await fetch(`${API_BASE}/users`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ nombres, apellidos, dni }),
            });

            if (response.ok) {
                alert("Usuario registrado exitosamente.");
                cargarUsuarios();
            } else {
                const errorData = await response.json();
                alert(`Error: ${errorData.error}`);
            }
        } catch (error) {
            console.error('Error al registrar el usuario:', error);
            alert('Hubo un problema al registrar el usuario.');
        }
    }

    async function cargarUsuarios() {
        try {
            const response = await fetch('/api/users');
            console.log(response);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            const usuarios = await response.json();
            const tabla = document.getElementById('cuerpoUsuarios');
            tabla.innerHTML = '';

            usuarios.forEach(user => {
                const fila = tabla.insertRow();
                fila.insertCell(0).textContent = user.id;
                fila.insertCell(1).textContent = user.nombres;
                fila.insertCell(2).textContent = user.apellidos;
                fila.insertCell(3).textContent = user.dni;
                fila.insertCell(4).textContent = user.email || 'N/A';
            });
        } catch (error) {
            console.error('Error al cargar los usuarios:', error);
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        cargarUsuarios();
    });
</script>
</body>
</html>
