@foreach($bitacoras as $bitacora)
    <tr>
        <td>{{ $bitacora->id }}</td>
        <td>{{ $bitacora->base_de_datos }}</td>
        <td>{{ $bitacora->tabla_afectada }}</td>
        <td>{{ ucfirst($bitacora->tipo_cambio) }}</td>
        <td>{{ $bitacora->fecha_ejecucion }}</td>
        <td>
            @if($bitacora->estado_de_bitacoras === 'pendiente')
                <span class="badge bg-warning text-dark">Pendiente</span>
            @elseif($bitacora->estado_de_bitacoras === 'finalizado')
                <span class="badge bg-success">Finalizado</span>
            @endif
        </td>
        <td>{{ $bitacora->usuario->nombre ?? 'Desconocido' }}</td>
        <td>
            <div class="d-flex flex-wrap gap-1">
                <a href="{{ route('bitacoras.show', $bitacora->id) }}" class="btn btn-sm btn-primary">Ver</a>

                @php $usuario = session('usuario'); @endphp
                @if(
                    ($bitacora->estado_de_bitacoras === 'pendiente' && $usuario['id'] === $bitacora->usuario_id) ||
                    ($bitacora->estado_de_bitacoras === 'finalizado' && $usuario['rol'] === 'admin')
                )
                    <a href="{{ route('bitacoras.edit', $bitacora->id) }}" class="btn btn-sm btn-warning"> Editar</a>

                    <form action="{{ route('bitacoras.destroy', $bitacora->id) }}" method="POST" 
                          onsubmit="return confirm('¿Estás seguro de eliminar esta bitácora?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"> Eliminar</button>
                    </form>
                @endif
            </div>
        </td>
    </tr>
@endforeach
