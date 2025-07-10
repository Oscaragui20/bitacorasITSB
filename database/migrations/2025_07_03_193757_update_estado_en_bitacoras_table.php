<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // ⚠️ Modifica el ENUM directamente con SQL (MySQL no permite modificar ENUM fácilmente con Blueprint)
        DB::statement("ALTER TABLE bitacoras MODIFY estado_de_bitacoras ENUM('pendiente', 'finalizado', 'eliminado') NOT NULL DEFAULT 'pendiente'");
    }

    public function down(): void
    {
        // Opción de reversión sin 'eliminado'
        DB::statement("ALTER TABLE bitacoras MODIFY estado_de_bitacoras ENUM('pendiente', 'finalizado') NOT NULL DEFAULT 'pendiente'");
    }
};
