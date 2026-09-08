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

            // La columna user_id ya existe en la tabla.
            // Solo agregamos las columnas que realmente faltan.

            // Prioridad:
            // 1 = Baja
            // 2 = Media
            // 3 = Alta
            $table->unsignedTinyInteger('prioridad')
                ->after('fecha_limite')
                ->default(2);

            // Categoría de la tarea
            $table->enum('categoria', [
                'Trabajo',
                'Estudio',
                'Personal'
            ])
            ->after('prioridad')
            ->default('Personal');
        });
    }

    /**
     * Revertir la migración.
     */
    public function down(): void
    {
        Schema::table('tareas', function (Blueprint $table) {

            $table->dropColumn([
                'prioridad',
                'categoria',
            ]);
        });
    }
};