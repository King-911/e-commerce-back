<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ItemCarrito extends Model
{
    use HasFactory, HasUuids;

    // Nombre exacto de la tabla en tu base de datos
    protected $table = 'item_carritos';

    // Configuración para ID tipo UUID (char(36))
    protected $keyType = 'string';
    public $incrementing = false;

    // Campos permitidos para asignación masiva
    protected $fillable = [
        'carrito_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
    ];

    /**
     * Relación: Un ítem pertenece a un carrito.
     */
    public function carrito()
    {
        return $this->belongsTo(Carrito::class, 'carrito_id');
    }

    /**
     * Relación: Un ítem está asociado a un producto.
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}