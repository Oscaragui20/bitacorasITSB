<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\AuthController;
use App\Exports\BitacorasExport;
use Maatwebsite\Excel\Facades\Excel;


use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Bitacora;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


Route::get('/', function () {
    return redirect('/login');
});

// 🔓 Rutas públicas (login / logout)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// 🔐 Rutas protegidas con middleware 'usuario'
Route::middleware(['usuario'])->group(function () {

    Route::put('/bitacoras/{id}/restaurar', [BitacoraController::class, 'restaurar'])->name('bitacoras.restaurar');

    // ✅ Exportar a Excel (corregido)
    Route::get('/exportar-excel', function () {
        $sesion = session('usuario');

        if (!$sesion || !isset($sesion['id'])) {
            return redirect('/login');
        }

        // Buscamos el usuario por ID desde la tabla `usuarios`
        $usuario = \App\Models\Usuario::find($sesion['id']);

        if (!$usuario) {
            return redirect('/login');
        }

        return Excel::download(new BitacorasExport($usuario), 'bitacoras.xlsx');
    })->name('bitacoras.export.excel');




Route::get('/exportar-pdf', function () {
    $usuario = session('usuario');

    if (!$usuario) {
        return redirect('/login');
    }

    $bitacoras = Bitacora::with('usuario')
        ->when($usuario['rol'] === 'usuario', fn($query) => $query->where('usuario_id', $usuario['id']))
        ->get();

    return Pdf::loadView('exports.bitacoras_pdf', compact('bitacoras'))
        ->download('bitacoras.pdf');
})->name('bitacoras.export.pdf');

    Route::get('/bitacoras/imprimir', [BitacoraController::class, 'imprimir'])->name('bitacoras.imprimir');


    // 📄 CRUD de Bitácoras
    Route::get('/bitacoras', [BitacoraController::class, 'index'])->name('bitacoras.index');         // Lista
    Route::get('/bitacoras/crear', [BitacoraController::class, 'create'])->name('bitacoras.create');  // Formulario crear
    Route::post('/bitacoras', [BitacoraController::class, 'store'])->name('bitacoras.store');         // Guardar nueva
    Route::get('/bitacoras/{id}', [BitacoraController::class, 'show'])->name('bitacoras.show');        // Ver detalle
    Route::get('/bitacoras/{id}/editar', [BitacoraController::class, 'edit'])->name('bitacoras.edit'); // Formulario editar
    Route::put('/bitacoras/{id}', [BitacoraController::class, 'update'])->name('bitacoras.update');    // Actualizar
    Route::delete('/bitacoras/{id}', [BitacoraController::class, 'destroy'])->name('bitacoras.destroy'); // Eliminar (lógico)
    Route::put('/bitacoras/{id}/finalizar', [BitacoraController::class, 'finalizar'])->name('bitacoras.finalizar'); // Finalizar
});
