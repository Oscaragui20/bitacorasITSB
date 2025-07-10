<?php

namespace App\Exports;

use App\Models\Bitacora;
use App\Models\Usuario; // ← esta es la buena
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BitacorasExport implements FromView
{
    protected $usuario;

    public function __construct(Usuario $usuario)
    {
        $this->usuario = $usuario;
    }

    public function view(): View
    {
        if ($this->usuario->rol === 'admin') {
            $bitacoras = Bitacora::with('usuario')->get();
        } else {
            $bitacoras = Bitacora::with('usuario')
                ->where('usuario_id', $this->usuario->id)
                ->get();
        }

        return view('exports.bitacoras', [
            'bitacoras' => $bitacoras
        ]);
    }
}
