<?php

namespace App\Models;

use App\Models\Categoria;
use App\Models\Tarea;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Campos que pueden ser asignados mediante Eloquent.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Campos ocultos.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Conversión de atributos.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relación:
     * Un usuario puede tener muchas tareas.
     */
    public function tareas(): HasMany
    {
        return $this->hasMany(Tarea::class);
    }

    /**
     * Relación:
     * Un usuario puede tener muchas categorías.
     */
    public function categorias(): HasMany
    {
        return $this->hasMany(Categoria::class);
    }
}