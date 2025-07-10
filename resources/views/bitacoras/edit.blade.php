<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Bitácora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/editar-bitacora.css') }}">


</head>

<body class="bg-light">
<div class="container py-5">
    <h2 class="mb-4 text-success"> Editar Bitácora #{{ $bitacora->id }}</h2>

    {{-- Mensaje de error de sesión --}}
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Errores de validación --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Errores encontrados:</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('bitacoras.update', $bitacora->id) }}">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-6">
                <label for="base_de_datos" class="form-label">Base de Datos:</label>
                <input type="text" name="base_de_datos" class="form-control" value="{{ old('base_de_datos', $bitacora->base_de_datos) }}" required>
            </div>

            <div class="col-md-6">
                <label for="tabla_afectada" class="form-label">Tabla Afectada:</label>
                <input type="text" name="tabla_afectada" class="form-control" value="{{ old('tabla_afectada', $bitacora->tabla_afectada) }}" required>
            </div>

            <div class="col-md-12">
                <label for="descripcion_cambio" class="form-label">Descripción del Cambio:</label>
                <textarea name="descripcion_cambio" class="form-control" rows="3" required>{{ old('descripcion_cambio', $bitacora->descripcion_cambio) }}</textarea>
            </div>

            <div class="col-md-12">
                <label for="justificacion" class="form-label">Justificación:</label>
                <input type="text" name="justificacion" class="form-control" value="{{ old('justificacion', $bitacora->justificacion) }}" required>
            </div>

            <div class="col-md-6">
                <label for="solicitado_por" class="form-label">Solicitado por:</label>
                <input type="text" name="solicitado_por" class="form-control" value="{{ old('solicitado_por', $bitacora->solicitado_por) }}" required>
            </div>

            <div class="col-md-6">
                <label for="autorizado_por" class="form-label">Autorizado por:</label>
                <input type="text" name="autorizado_por" class="form-control" value="{{ old('autorizado_por', $bitacora->autorizado_por) }}" required>
            </div>

            <div class="col-md-6">
                <label for="fecha_ejecucion" class="form-label">Fecha de Ejecución:</label>
                <input type="date" name="fecha_ejecucion" class="form-control" value="{{ old('fecha_ejecucion', $bitacora->fecha_ejecucion) }}" required>
            </div>

            <div class="col-md-6">
                <label for="hora_ejecucion" class="form-label">Hora de Ejecución:</label>
                <input type="time" name="hora_ejecucion" class="form-control" value="{{ old('hora_ejecucion', $bitacora->hora_ejecucion) }}" required>
            </div>

            <div class="col-md-6">
                <label for="tipo_cambio" class="form-label">Tipo de Cambio:</label>
                <select name="tipo_cambio" class="form-select" required>
                    <option value="insertar" {{ $bitacora->tipo_cambio === 'insertar' ? 'selected' : '' }}>Insertar</option>
                    <option value="actualizar" {{ $bitacora->tipo_cambio === 'actualizar' ? 'selected' : '' }}>Actualizar</option>
                    <option value="eliminar" {{ $bitacora->tipo_cambio === 'eliminar' ? 'selected' : '' }}>Eliminar</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="herramienta_usadas" class="form-label">Herramientas Usadas:</label>
                <input type="text" name="herramienta_usadas" class="form-control" value="{{ old('herramienta_usadas', $bitacora->herramienta_usadas) }}" required>
            </div>

            <div class="col-md-6">
                <label for="respaldo_previo" class="form-label">Respaldo Previo:</label>
                <input type="text" name="respaldo_previo" class="form-control" value="{{ old('respaldo_previo', $bitacora->respaldo_previo) }}" required>
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-between">
            <a href="{{ route('bitacoras.index') }}" class="btn btn-outline-secondary">← Cancelar</a>
            <button type="submit" class="btn btn-success">💾 Guardar Cambios</button>
        </div>
    </form>
</div>
</body>
</html>
