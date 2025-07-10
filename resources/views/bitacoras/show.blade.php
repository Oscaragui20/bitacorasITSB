<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Bitácora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/editar-bitacora.css') }}">

</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4">Detalle de la Bitácora #{{ $bitacora->id }}</h2>

    <a href="{{ route('bitacoras.index') }}" class="btn btn-secondary mb-3">← Volver al Historial</a>

    <table class="table table-bordered">
        <tr><th>Base de Datos</th><td>{{ $bitacora->base_de_datos }}</td></tr>
        <tr><th>Tabla Afectada</th><td>{{ $bitacora->tabla_afectada }}</td></tr>
        <tr><th>Descripción del Cambio</th><td>{{ $bitacora->descripcion_cambio }}</td></tr>
        <tr><th>Justificación</th><td>{{ $bitacora->justificacion }}</td></tr>
        <tr><th>Solicitado Por</th><td>{{ $bitacora->solicitado_por }}</td></tr>
        <tr><th>Autorizado Por</th><td>{{ $bitacora->autorizado_por }}</td></tr>
        <tr><th>Fecha de Ejecución</th><td>{{ $bitacora->fecha_ejecucion }}</td></tr>
        <tr><th>Hora de Ejecución</th><td>{{ $bitacora->hora_ejecucion }}</td></tr>
        <tr><th>Herramienta Usada</th><td>{{ $bitacora->herramienta_usadas }}</td></tr>
        <tr><th>Respaldo Previo</th><td>{{ $bitacora->respaldo_previo }}</td></tr>
        <tr><th>Tipo de Cambio</th><td>{{ ucfirst($bitacora->tipo_cambio) }}</td></tr>
        <tr>
            <th>Estado</th>
            <td>
                @if($bitacora->estado_de_bitacoras === 'pendiente')
                    <form action="{{ route('bitacoras.finalizar', $bitacora->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-warning">Finalizar Bitácora</button>
                    </form>
                @else
                    <span class="badge bg-success">Ya finalizada</span>
                @endif
            </td>
        </tr>
        <tr><th>Creado por</th><td>{{ $bitacora->usuario->nombre ?? 'Desconocido' }}</td></tr>
    </table>
</div>

</body>
</html>