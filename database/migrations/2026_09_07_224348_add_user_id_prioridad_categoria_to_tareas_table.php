<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tareas', function (Blueprint $table) {
            // Relación entre la tarea y el usuario autenticado
            $table->foreignId('user_id')
                ->after('id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Prioridad de la tarea: 1 = Baja, 2 = Media, 3 = Alta
            $table->unsignedTinyInteger('prioridad')
                ->after('fecha_limite')
                ->default(2);

            // Categoría de la tarea
            $table->enum('categoria', [
                'Trabajo',
                'Estudio',
                'Personal'
            ])->after('prioridad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tareas', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn([
                'user_id',
                'prioridad',
                'categoria',
            ]);
        });
    }
};