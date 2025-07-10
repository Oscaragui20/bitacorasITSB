<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bitacoras', function (Blueprint $table) {
            $table->id();

            $table->string('base_de_datos', 100)->nullable();
            $table->string('tabla_afectada', 100)->nullable();
            $table->text('descripcion_cambio');
            $table->string('justificacion', 100)->nullable();
            $table->string('solicitado_por', 100)->nullable();
            $table->string('autorizado_por', 100)->nullable();
            $table->date('fecha_ejecucion');
            $table->time('hora_ejecucion');
            $table->enum('tipo_cambio', ['insertar', 'actualizar', 'eliminar'])->nullable();
            $table->string('herramienta_usadas', 100)->nullable();
            $table->string('respaldo_previo', 255)->nullable();
            $table->enum('estado_de_bitacoras', ['pendiente', 'finalizado'])->default('pendiente');

            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bitacoras');
    }
};
