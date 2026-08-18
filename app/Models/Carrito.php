<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Carrito extends Model
{
    use HasFactory, HasUuids;

    // Nombre exacto de la tabla según tu base de datos
    protected $table = 'carritos';

    // Configuración para ID tipo UUID (char(36))
    protected $keyType = 'string';
    public $incrementing = false;

    // Campos permitidos para asignación masiva
    protected $fillable = [
        'usuario_id',
    ];

    /**
     * Relación: Un carrito pertenece a un usuario.
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    /**
     * Relación: Un carrito tiene muchos ítems (de la tabla item_carritos).
     */
    public function items()
    {
        return $this->hasMany(ItemCarrito::class, 'carrito_id');
    }
}