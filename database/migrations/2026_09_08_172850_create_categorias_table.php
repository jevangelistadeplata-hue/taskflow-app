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
        Schema::create('categorias', function (Blueprint $table) {

            // Identificador de la categoría
            $table->id();

            // Usuario propietario de la categoría
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            // Nombre de la categoría
            $table->string('nombre');

            // Fecha de creación y actualización
            $table->timestamps();

            // Un usuario no puede tener dos categorías
            // con exactamente el mismo nombre.
            $table->unique(['user_id', 'nombre']);
        });
    }

    /**
     * Revertir la migración.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};