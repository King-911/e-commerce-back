<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'usuarios';

    protected $fillable = ['email', 'password_hash', 'rol'];

    // Oculta el password hash para que no se filtre en las respuestas JSON
    protected $hidden = ['password_hash'];

    public function ordenes()
    {
        return $this->hasMany(Orden::class);
    }

    public function carrito()
    {
        return $this->hasOne(Carrito::class);
    }
}