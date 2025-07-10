<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Necesario para login
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'contraseña',
        'rol',
    ];

    protected $hidden = [
        'contraseña',
    ];

    // Relación con bitácoras (1 usuario tiene muchas bitácoras)
    public function bitacoras()
    {
        return $this->hasMany(Bitacora::class);
    }

    // Necesario para autenticación manual
    public function getAuthPassword()
    {
        return $this->contraseña;
    }
}
