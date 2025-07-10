<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte de Bitácoras</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Reporte de Bitácoras</h2>
    <table>
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
                    <td>
                        @switch($bitacora->estado_de_bitacoras)
                            @case('pendiente') Pendiente @break
                            @case('finalizada') Finalizada @break
                            @default No definido
                        @endswitch
                    </td>
                    <td>{{ optional($bitacora->created_at)->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
