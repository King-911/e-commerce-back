<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pagos';

    protected $fillable = [
        'orden_id',
        'monto',
        'metodo_pago',
        'estado',
    ];

    public function orden()
    {
        return $this->belongsTo(Orden::class, 'orden_id');
    }
}