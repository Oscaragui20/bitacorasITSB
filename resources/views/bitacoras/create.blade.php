<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Nueva Bitácora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('css/bitacora-form.css') }}">


</head>
<body class="bg-light">
<div class="container py-5">
    <h2 class="mb-3">Registrar Nueva Bitácora</h2>

    <p class="text-muted">Los campos marcados con <span class="obligatorio"></span> son obligatorios.</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Hay algunos errores. Por favor corrige los campos marcados en rojo.
        </div>
    @endif

    <form action="{{ route('bitacoras.store') }}" method="POST">
        @csrf

        @foreach ([
            'base_de_datos' => 'Base de Datos',
            'tabla_afectada' => 'Tabla Afectada',
            'descripcion_cambio' => 'Descripción del Cambio',
            'justificacion' => 'Justificación',
            'solicitado_por' => 'Solicitado Por',
            'autorizado_por' => 'Autorizado Por',
            'fecha_ejecucion' => 'Fecha de Ejecución',
            'hora_ejecucion' => 'Hora de Ejecución',
            'herramienta_usadas' => 'Herramienta Usada',
            'respaldo_previo' => 'Respaldo Previo',
        ] as $name => $label)
            @php
                $esObligatorio = true;
            @endphp
            <div class="mb-3">
                <label class="form-label">
                    {{ $label }} <span class="obligatorio"></span>
                </label>
                <input 
                    type="{{ in_array($name, ['fecha_ejecucion']) ? 'date' : (in_array($name, ['hora_ejecucion']) ? 'time' : 'text') }}"
                    name="{{ $name }}"
                    class="form-control @error($name) is-invalid @enderror"
                    value="{{ old($name) }}">
                @error($name)
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        @endforeach

        <div class="mb-3">
            <label class="form-label">Tipo de Cambio <span class="obligatorio"></span></label>
            <select name="tipo_cambio" class="form-select @error('tipo_cambio') is-invalid @enderror">
                <option value="">-- Selecciona --</option>
                <option value="insertar" {{ old('tipo_cambio') == 'insertar' ? 'selected' : '' }}>Insertar</option>
                <option value="actualizar" {{ old('tipo_cambio') == 'actualizar' ? 'selected' : '' }}>Actualizar</option>
                <option value="eliminar" {{ old('tipo_cambio') == 'eliminar' ? 'selected' : '' }}>Eliminar</option>
            </select>
            @error('tipo_cambio')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Guardar Bitácora</button>
        <a href="{{ route('bitacoras.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>