<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    use HasFactory;

    protected $table = 'bitacoras';

    protected $fillable = [
        'base_de_datos',
        'tabla_afectada',
        'descripcion_cambio',
        'justificacion',
        'solicitado_por',
        'autorizado_por',
        'fecha_ejecucion',
        'hora_ejecucion',
        'tipo_cambio',
        'herramienta_usadas',
        'respaldo_previo',
        'estado_de_bitacoras',
        'usuario_id',
    ];

    // ✅ Asignar valor por defecto si no se proporciona
    protected $attributes = [
        'estado_de_bitacoras' => 'pendiente',
    ];

    // Relación con el modelo Usuario
    public function usuario()
    {
        return $this->belongsTo(\App\Models\Usuario::class);
    }
}
