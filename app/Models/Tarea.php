<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tarea extends Model
{
    use SoftDeletes;

    /**
     * Campos que se pueden asignar mediante Tarea::create() o update().
     */
    protected $fillable = [
        'user_id',
        'titulo',
        'descripcion',
        'estado',
        'fecha_limite',
        'prioridad',
        'categoria',
    ];

    /**
     * Estado predeterminado de una nueva tarea.
     */
    protected $attributes = [
        'estado' => 'pendiente',
        'prioridad' => 2,
    ];

    /**
     * Conversión de tipos de los atributos.
     */
    protected function casts(): array
    {
        return [
            'fecha_limite' => 'date',
            'prioridad' => 'integer',
        ];
    }

    /**
     * Una tarea pertenece a un usuario.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}