<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Impresión de Bitácoras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>
<div class="container my-4">
    <div class="no-print mb-3 text-end">
        <button onclick="window.print()" class="btn btn-primary">🖨️ Imprimir</button>
        <a href="{{ route('bitacoras.index') }}" class="btn btn-secondary">🔙 Volver</a>
    </div>

    <h2 class="mb-4">Listado de Bitácoras</h2>

    <table class="table table-bordered">
        <thead class="table-light">
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
                    <td>{{ $bitacora->estado_de_bitacoras }}</td>
                    <td>{{ $bitacora->created_at ? $bitacora->created_at->format('d/m/Y H:i') : 'Sin fecha' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
