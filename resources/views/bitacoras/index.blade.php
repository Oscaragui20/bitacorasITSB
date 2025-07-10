<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Bitácoras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('css/fondobitacoras.css') }}">
</head>

<body class="bg-light">

<div class="container py-5">
    {{-- Encabezado con nombre y botón de cerrar sesión --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('bitacoras.index') }}" class="btn btn-primary">Historial</a>
            <a href="{{ route('bitacoras.create') }}" class="btn btn-info">Nueva Bitácora</a>
            <a href="{{ route('bitacoras.export.excel') }}" class="btn btn-success"> Exportar a Excel</a>
            <a href="{{ route('bitacoras.export.pdf') }}" class="btn btn-danger"> Exportar a PDF</a>
            <a href="{{ route('bitacoras.imprimir') }}" class="btn btn-warning"> Imprimir</a>

        </div>
        <div>
            <span class="me-2">👤 {{ session('usuario')['nombre'] ?? 'Usuario' }}</span>
            <a href="{{ route('logout') }}" class="btn btn-danger">Cerrar sesión</a>
        </div>
    </div>

    <h2 class="mb-3">Historial de Bitácoras</h2>

    {{-- 🔍 Formulario de búsqueda + filtros --}}
    <form method="GET" action="{{ route('bitacoras.index') }}" class="mb-4 row g-3" id="form-filtros">
        <div class="col-md-4">
            <label for="buscar" class="form-label">Buscar:</label>
            <input type="text" name="buscar" id="buscar" class="form-control"
                   placeholder="Descripción, tabla o usuario"
                   value="{{ request('buscar') }}">
        </div>

        <div class="col-md-4">
            <label for="tipo_cambio" class="form-label">Tipo de cambio:</label>
            <select name="tipo_cambio" id="tipo_cambio" class="form-select">
                <option value="">-- Todos --</option>
                <option value="insertar" {{ request('tipo_cambio') == 'insertar' ? 'selected' : '' }}>Insertar</option>
                <option value="actualizar" {{ request('tipo_cambio') == 'actualizar' ? 'selected' : '' }}>Actualizar</option>
                <option value="eliminar" {{ request('tipo_cambio') == 'eliminar' ? 'selected' : '' }}>Eliminar</option>
            </select>
        </div>

        <div class="col-md-4">
            <label for="estado" class="form-label">Estado:</label>
            <select name="estado" id="estado" class="form-select">
                <option value="">-- Todos --</option>
                <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="finalizado" {{ request('estado') == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
            </select>
        </div>

        <div class="col-md-4">
            <label for="fecha_desde" class="form-label">Fecha desde:</label>
            <input type="date" name="fecha_desde" id="fecha_desde" class="form-control"
                   value="{{ request('fecha_desde') }}">
        </div>

        <div class="col-md-4">
            <label for="fecha_hasta" class="form-label">Fecha hasta:</label>
            <input type="date" name="fecha_hasta" id="fecha_hasta" class="form-control"
                   value="{{ request('fecha_hasta') }}">
        </div>

        <div class="col-md-4 d-flex align-items-end">
            <div class="d-flex gap-2 w-100">
                <button type="submit" class="btn btn-success w-50">🔍 Buscar</button>
                <a href="{{ route('bitacoras.index') }}" class="btn btn-outline-secondary w-50">Limpiar</a>
            </div>
        </div>
    </form>

    {{-- ✅ Mensajes --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Tabla de bitácoras activas --}}
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Base de Datos</th>
            <th>Tabla Afectada</th>
            <th>Tipo de Cambio</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th>Creado por</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody id="bitacoras-tbody">
            @if($bitacoras->count())
                @include('bitacoras._filas')
            @else
                <tr>
                    <td colspan="8" class="text-center text-muted">No hay bitácoras que coincidan con tu búsqueda.</td>
                </tr>
            @endif
        </tbody>
    </table>

    {{-- Sección de eliminadas --}}
    @if($bitacorasEliminadas->count())
        <h4 class="mt-5 text-danger"> Bitácoras Eliminadas</h4>
        <table class="table table-bordered table-striped mt-3">
            <thead class="table-danger">
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Tabla</th>
                <th>Fecha</th>
                <th>Creado por</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bitacorasEliminadas as $bitacora)
                <tr>
                    <td>{{ $bitacora->id }}</td>
                    <td>{{ $bitacora->descripcion_cambio }}</td>
                    <td>{{ $bitacora->tabla_afectada }}</td>
                    <td>{{ $bitacora->fecha_ejecucion }}</td>
                    <td>{{ $bitacora->usuario->nombre ?? 'Desconocido' }}</td>
                    <td>
                        <form action="{{ route('bitacoras.restaurar', $bitacora->id) }}" method="POST" onsubmit="return confirm('¿Deseas restaurar esta bitácora?');">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm btn-success">♻️ Restaurar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>

<script>
    let page = 1;
    let loading = false;
    let noMoreData = false;

    window.addEventListener('scroll', () => {
        if (loading || noMoreData) return;

        const scrollBottom = window.innerHeight + window.scrollY;
        const documentHeight = document.body.offsetHeight;

        if (scrollBottom >= documentHeight - 100) {
            loadMoreBitacoras();
        }
    });

    function loadMoreBitacoras() {
        loading = true;
        page++;

        const form = document.querySelector('#form-filtros');
        const formData = new FormData(form);
        const url = new URL("{{ route('bitacoras.index') }}");
        url.searchParams.set('page', page);

        formData.forEach((value, key) => {
            if (value) {
                url.searchParams.set(key, value);
            }
        });

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => {
            if (!res.ok) throw new Error('Error al cargar más registros');
            return res.text();
        })
        .then(html => {
            if (html.trim() === '') {
                noMoreData = true;
            } else {
                document.querySelector('#bitacoras-tbody').insertAdjacentHTML('beforeend', html);
            }
        })
        .catch(err => {
            console.error('Error:', err);
        })
        .finally(() => {
            loading = false;
        });
    }
</script>


</body>
</html>
