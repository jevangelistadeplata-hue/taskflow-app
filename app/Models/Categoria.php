<?php

namespace App\Models;

use App\Models\Tarea;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    /**
     * Campos que pueden ser asignados mediante Eloquent.
     */
    protected $fillable = [
        'user_id',
        'nombre',
    ];

    /**
     * Relación:
     *
     * Una categoría pertenece a un usuario.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación:
     *
     * Una categoría puede tener muchas tareas.
     */
    public function tareas(): HasMany
    {
        return $this->hasMany(Tarea::class, 'categoria_id');
    }
}