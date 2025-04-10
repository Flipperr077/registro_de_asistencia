<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Registro de Estudiantes')</title>
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
    }

    h1 {
        text-align: center;
        color: #1a73e8;
        margin-bottom: 30px;
    }

    .form-container {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 4px;
        flex-wrap: wrap;
    }

    .form-group {
        flex: 1;
        min-width: 150px;
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
        height: 38px;
        margin-top: 24px;
    }

    .boton-agregar {
        background-color: #28a745;
        margin-left: 10px;
    }

    button:hover {
        opacity: 0.9;
    }

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
        background-color: #f8f9fa;
        font-weight: bold;
    }

    tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    tr:hover {
        background-color: #f0f0f0;
    }

    .action-button {
        background-color: #dc3545;
        padding: 6px 12px;
        font-size: 14px;
        margin-right: 5px;
    }

    .error {
        border-color: #dc3545;
    }

    .error-message {
        color: #dc3545;
        font-size: 12px;
        margin-top: 5px;
    }

    .fecha-hora {
        white-space: nowrap;
    }

    .nombres-container, .apellidos-container {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
</style>
@yield('styles')
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
    @yield('scripts')
    </body>
</html>