<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Exportar Bitácoras</title>
</head>
<body>
    <h2>Listado de Bitácoras</h2>

    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Descripción</th>
                <th>Tipo de Cambio</th>
                <th>Estado</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bitacoras as $bitacora)
                <tr>
                    <td>{{ $bitacora->id }}</td>
                    <td>{{ $bitacora->usuario->nombre ?? 'N/A' }}</td>
                    <td>{{ $bitacora->descripcion_cambio }}</td>
                    <td>{{ $bitacora->tipo_cambio }}</td>
                    <td>{{ $bitacora->estado_de_bitacoras ?? 'pendiente' }}</td>
                    <td>{{ $bitacora->created_at ? $bitacora->created_at->format('d/m/Y H:i') : 'Sin fecha' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>