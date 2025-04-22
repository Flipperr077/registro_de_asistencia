<x-guest-layout>
    <div class="container" id="welcome">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <!-- Ingreso de DNI para asistencia -->
                <form action="{{ route('attendance.store-present') }}" name="asistencia" method="post">
                    @csrf
                    <h1 class="my-4">Registro de Asistencia de Estudiantes</h1>
                    <!-- Mensaje de Estado -->
                    @if(Session('attendance-status'))
                        <div class="col-md-12">
                            <div class="alert alert-info">
                                <p>{{ Session('attendance-status') }}</p>
                            </div>
                        </div>
                    @endif
                    <!-- Mensaje de error -->
                    @if(Session('error'))
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <p>{{ Session('error') }}</p>
                            </div>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="attendance_dni" class="form-label">Ingresar DNI (8 números)</label>
                                <input type="number" class="form-control" id="attendance_dni" name="attendance_dni" maxlength="8" placeholder="DNI" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Registrar Asistencia</button>
                            <p class="text-secondary">
                                <small>*Esto registrará al usuario como PRESENTE en la fecha actual. Para un registro de asistencia más detallado, dirigirse a vista dedicada.</small>
                            </p>
                        </div>
                    </div>
                </form>

                <!-- Tabla de asistencia -->
                <h2 class="my-3">Historial de Asistencia</h2>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>DNI</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody id="cuerpoTabla">
                            @foreach ($attendances as $attendance)
                                <tr>
                                    <td>{{ $attendance->user->name }}</td>
                                    <td>{{ $attendance->user->lastname }}</td>
                                    <td>{{ $attendance->user->dni }}</td>
                                    <td>{{ $attendance->created_at }}</td>
                                </tr>
                            @endforeach
                            @if (count($attendances) == 0)
                                <tr>
                                    <td colspan="4" class="text-center">No hay registros de asistencia.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <p class="text-secondary">
                        <small>{{ count($attendances) }} registros de asistencia.</small>
                    </p>
                </div>

                <!-- Usuarios Registrados -->
                <h2 class="my-3">Usuarios Registrados</h2>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>DNI</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody id="users_table">
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->lastname }}</td>
                                    <td>{{ $user->dni }}</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                            @endforeach
                            @if (count($users) == 0)
                                <tr>
                                    <td colspan="5" class="text-center">No hay usuarios registrados.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <p class="text-secondary">
                        <small>{{ count($users) }} usuarios registrados.</small>
                    </p>
                </div>

                <!-- Formulario para Registrar Usuario -->
                <form action="{{ route('users.store') }}" method="post" id="register_new_user">
                    @csrf
                    <h2 class="my-3">Registrar Nuevo Usuario</h2>
                    <!-- Mensaje de error -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- Mensajes de sesión (si existen) -->
                    @if(Session('status'))
                        <div class="col-md-12">
                            <div class="alert alert-success">
                                <p>{{ Session('user-status') }}</p>
                            </div>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="name">Nombre</label>
                                <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Nombre" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="lastname">Apellido</label>
                                <input class="form-control" type="text" id="lastname" name="lastname" value="{{ old('lastname') }}" placeholder="Apellido" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="dni">DNI (8 números)</label>
                                <input class="form-control" type="number" id="dni" name="dni" maxlength="8" value="{{ old('dni') }}" placeholder="DNI" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input class="form-control" type="text" id="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
                            </div>
                            <button class="btn btn-success" type="submit">Registrar Usuario</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>