<x-guest-layout>
@section('title', 'Agregar Estudiante')
<h1>Registro de Estudiantes</h1>
@if($errors->any())
<div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 15px; border-radius: 4px;">
<ul>
@foreach($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
<form action="{{ route('school-days.store') }}" method="POST">
    @csrf
    <div class="form-container">
        <div class="form-group">
            <label for="nombres">Nombres:</label>
            <div id="nombres-container" class="nombres-container">
                <input type="text" name="nombres[]" class="nombre-input" required>
            </div>
            <button type="button" class="boton-agregar" onclick="agregarNombreApellido('nombres')">+ Nombre</button>
        </div>
        <div class="form-group">
        <label for="apellidos">Apellidos:</label>
        <div id="apellidos-container" class="apellidos-container">
            <input type="text" name="apellidos[]" class="apellido-input" required>
        </div>
        <button type="button" class="boton-agregar" onclick="agregarNombreApellido('apellidos')">+ Apellido</button>
    </div>

    <div class="form-group">
        <label for="dni">DNI (8 números):</label>
        <input type="text" id="dni" name="dni" required maxlength="8" 
               onkeypress="return event.charCode >= 48 && event.charCode <= 57"
               value="{{ old('dni') }}">
    </div>

    <button type="submit">Agregar</button>
</div>
</form>
@endsection
@section('scripts')
<script>
    function agregarNombreApellido(tipo) {
        const container = document.getElementById(`${tipo}-container`);
        const input = document.createElement('input');
        input.type = 'text';
        input.name = `${tipo}[]`;
        input.className = `${tipo.slice(0, -1)}-input`;
        input.required = true;

        const removeButton = document.createElement('button');
        removeButton.textContent = 'X';
        removeButton.type = 'button';
        removeButton.className = 'action-button';
        removeButton.onclick = function() {
            container.removeChild(input);
            container.removeChild(removeButton);
        };

        container.appendChild(input);
        container.appendChild(removeButton);
    }

    // Validación de DNI
    document.getElementById('dni').addEventListener('paste', function(e) {
        let paste = (e.clipboardData || window.clipboardData).getData('text');
        if (!/^\d*$/.test(paste)) {
            e.preventDefault();
        }
    });

    document.getElementById('dni').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
        if (this.value.length > 8) {
            this.value = this.value.slice(0, 8);
        }
    });
</script>
</x-guest-layout>