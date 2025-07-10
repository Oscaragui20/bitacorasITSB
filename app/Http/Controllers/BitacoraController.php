<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bitacora;

use App\Exports\BitacorasExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class BitacoraController extends Controller
{
    // Mostrar historial de bitácoras con filtros
    public function index(Request $request)
    {
        $usuario = session('usuario');

        if (!$usuario) {
            return redirect()->route('login.form');
        }

        $query = Bitacora::query();

        // Excluir eliminadas
        $query->where('estado_de_bitacoras', '!=', 'eliminado');

        // Filtro por rol
        if ($usuario['rol'] !== 'admin') {
            $query->where('usuario_id', $usuario['id']);
        }

        // Filtros
        if ($request->filled('buscar')) {
            $busqueda = $request->input('buscar');
            $query->where(function ($q) use ($busqueda) {
                $q->where('descripcion_cambio', 'like', "%$busqueda%")
                  ->orWhere('tabla_afectada', 'like', "%$busqueda%")
                  ->orWhereHas('usuario', function ($sub) use ($busqueda) {
                      $sub->where('nombre', 'like', "%$busqueda%");
                  });
            });
        }

        if ($request->filled('tipo_cambio')) {
            $query->where('tipo_cambio', $request->input('tipo_cambio'));
        }

        if ($request->filled('estado')) {
            $query->where('estado_de_bitacoras', $request->input('estado'));
        }

        if ($request->filled('fecha_desde')) {
            $query->whereDate('fecha_ejecucion', '>=', $request->input('fecha_desde'));
        }

        if ($request->filled('fecha_hasta')) {
            $query->whereDate('fecha_ejecucion', '<=', $request->input('fecha_hasta'));
        }

        // Paginación (scroll infinito)
        $bitacoras = $query->with('usuario')
                           ->orderBy('created_at', 'desc')
                           ->paginate(10);

        // Bitácoras eliminadas (no paginadas por ahora)
        $bitacorasEliminadas = Bitacora::where('estado_de_bitacoras', 'eliminado')
            ->when($usuario['rol'] !== 'admin', function ($q) use ($usuario) {
                return $q->where('usuario_id', $usuario['id']);
            })
            ->with('usuario')
            ->get();

        // Si es AJAX, devolver solo las filas HTML
        if ($request->ajax()) {
            return view('bitacoras._filas', compact('bitacoras'))->render();
        }

        // Si es carga normal, devolver vista completa
        return view('bitacoras.index', compact('bitacoras', 'bitacorasEliminadas'));
    }

    // Ver detalle de una bitácora
    public function show($id)
    {
        $bitacora = Bitacora::findOrFail($id);
        return view('bitacoras.show', compact('bitacora'));
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $usuario = session('usuario');
        $bitacora = Bitacora::findOrFail($id);

        if ($bitacora->usuario_id !== $usuario['id']) {
            return redirect()->route('bitacoras.index')
                ->with('error', 'No tienes permiso para editar esta bitácora.');
        }

        if ($bitacora->estado_de_bitacoras === 'finalizado' && $usuario['rol'] !== 'admin') {
            return redirect()->route('bitacoras.index')
                ->with('error', 'Solo un administrador puede editar una bitácora finalizada.');
        }

        return view('bitacoras.edit', compact('bitacora'));
    }

    // Actualizar bitácora
    public function update(Request $request, $id)
    {
        $usuario = session('usuario');
        $bitacora = Bitacora::findOrFail($id);

        if ($bitacora->usuario_id !== $usuario['id']) {
            return redirect()->route('bitacoras.index')
                ->with('error', 'No tienes permiso para editar esta bitácora.');
        }

        if ($bitacora->estado_de_bitacoras === 'finalizado') {
            return redirect()->route('bitacoras.index')
                ->with('error', 'No se puede editar una bitácora finalizada.');
        }

        $request->validate([
            'base_de_datos'       => 'required|string|max:100',
            'tabla_afectada'      => 'required|string|max:100',
            'descripcion_cambio'  => 'required|string|max:500',
            'justificacion'       => 'required|string|max:255',
            'solicitado_por'      => 'required|string|max:100',
            'autorizado_por'      => 'required|string|max:100',
            'fecha_ejecucion'     => 'required|date',
            'hora_ejecucion'      => 'required',
            'tipo_cambio'         => 'required|in:insertar,actualizar,eliminar',
            'herramienta_usadas'  => 'required|string|max:100',
            'respaldo_previo'     => 'required|string|max:255',
        ]);

        $bitacora->update($request->all());

        return redirect()->route('bitacoras.index')->with('success', 'Bitácora actualizada correctamente.');
    }

    // Finalizar bitácora
    public function finalizar($id)
    {
        $usuario = session('usuario');
        $bitacora = Bitacora::findOrFail($id);

        if ($bitacora->usuario_id !== $usuario['id']) {
            return redirect()->route('bitacoras.index')
                ->with('error', 'No tienes permiso para finalizar esta bitácora porque no te pertenece.');
        }

        if ($bitacora->estado_de_bitacoras === 'finalizado') {
            return redirect()->route('bitacoras.index')
                ->with('error', 'La bitácora ya ha sido finalizada.');
        }

        $bitacora->estado_de_bitacoras = 'finalizado';
        $bitacora->save();

        return redirect()->route('bitacoras.index')
            ->with('success', 'Bitácora finalizada correctamente.');
    }

    // Eliminar bitácora (lógico)
    public function destroy($id)
    {
        $usuario = session('usuario');
        $bitacora = Bitacora::findOrFail($id);

        if ($bitacora->usuario_id !== $usuario['id']) {
            return redirect()->route('bitacoras.index')
                ->with('error', 'No tienes permiso para eliminar esta bitácora.');
        }

        if ($bitacora->estado_de_bitacoras === 'finalizado') {
            return redirect()->route('bitacoras.index')
                ->with('error', 'No puedes eliminar una bitácora finalizada.');
        }

        $bitacora->estado_de_bitacoras = 'eliminado';
        $bitacora->save();

        return redirect()->route('bitacoras.index')
            ->with('success', 'Bitácora eliminada correctamente.');
    }

    // Restaurar bitácora eliminada
    public function restaurar($id)
    {
        $usuario = session('usuario');
        $bitacora = Bitacora::findOrFail($id);

        if ($bitacora->usuario_id !== $usuario['id']) {
            return redirect()->route('bitacoras.index')->with('error', 'No tienes permiso para restaurar esta bitácora.');
        }

        if ($bitacora->estado_de_bitacoras !== 'eliminado') {
            return redirect()->route('bitacoras.index')->with('error', 'Solo se pueden restaurar bitácoras eliminadas.');
        }

        $bitacora->estado_de_bitacoras = 'pendiente';
        $bitacora->save();

        return redirect()->route('bitacoras.index')->with('success', 'Bitácora restaurada exitosamente.');
    }

    // Mostrar formulario para nueva bitácora
    public function create()
    {
        return view('bitacoras.create');
    }

    // Guardar nueva bitácora
    public function store(Request $request)
    {
        $usuario = session('usuario');

        if (!$usuario) {
            return redirect()->route('login.form');
        }

        $request->validate([
            'base_de_datos'       => 'required|string|max:100',
            'tabla_afectada'      => 'required|string|max:100',
            'descripcion_cambio'  => 'required|string|max:500',
            'justificacion'       => 'required|string|max:255',
            'solicitado_por'      => 'required|string|max:100',
            'autorizado_por'      => 'required|string|max:100',
            'fecha_ejecucion'     => 'required|date',
            'hora_ejecucion'      => 'required',
            'tipo_cambio'         => 'required|in:insertar,actualizar,eliminar',
            'herramienta_usadas'  => 'required|string|max:100',
            'respaldo_previo'     => 'required|string|max:255',
        ]);

        $datos = $request->all();
        $datos['usuario_id'] = $usuario['id'];
        $datos['estado_de_bitacoras'] = 'pendiente';

        Bitacora::create($datos);

        return redirect()->route('bitacoras.index')->with('success', 'Bitácora registrada exitosamente.');
    }

    public function exportExcel()
{
    $usuario = Auth::user();
    return Excel::download(new BitacorasExport($usuario), 'bitacoras.xlsx');
}
public function imprimir()
{
    $usuario = session('usuario');

    if (!$usuario) {
        return redirect()->route('login');
    }

    // Si es admin, todas las bitácoras; si no, solo las suyas
    if ($usuario['rol'] === 'admin') {
        $bitacoras = Bitacora::with('usuario')->get();
    } else {
        $bitacoras = Bitacora::with('usuario')
            ->where('usuario_id', $usuario['id'])
            ->get();
    }

    return view('bitacoras.imprimir', compact('bitacoras'));
}


}