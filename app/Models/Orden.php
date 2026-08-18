<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'ordenes'; // 👈 Agregamos esta línea

    const CREATED_AT = 'creado_en';
    const UPDATED_AT = null;

    protected $fillable = ['usuario_id', 'estado', 'total'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function itemOrdenes()
    {
        return $this->hasMany(ItemOrden::class);
    }
}