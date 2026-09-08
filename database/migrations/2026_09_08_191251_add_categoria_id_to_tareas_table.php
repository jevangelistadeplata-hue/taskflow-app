<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecutar la migración.
     */
    public function up(): void
    {
        Schema::table('tareas', function (Blueprint $table) {

            // Relación entre la tarea y su categoría.
            $table->foreignId('categoria_id')
                ->nullable()
                ->after('prioridad')
                ->constrained('categorias')
                ->nullOnDelete();
        });
    }

    /**
     * Revertir la migración.
     */
    public function down(): void
    {
        Schema::table('tareas', function (Blueprint $table) {

            $table->dropForeign(['categoria_id']);

            $table->dropColumn('categoria_id');
        });
    }
};