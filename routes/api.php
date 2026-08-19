<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController; 
use App\Http\Controllers\OrdenController;   
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ItemCarritoController;
use App\Http\Controllers\ItemOrdenController;
use App\Http\Controllers\PagoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rutas personalizadas (deben ir arriba de los apiResource para evitar conflictos de parámetros)
Route::get('/carritos/usuario/{usuario_id}', [CarritoController::class, 'obtenerPorUsuario']);
Route::get('categorias/{id}/productos', [ProductoController::class, 'porCategoria']);

// Rutas Resource estándar
Route::apiResource('categorias', CategoriaController::class);
Route::apiResource('productos', ProductoController::class);
Route::post('/login', [UsuarioController::class, 'login']);
Route::apiResource('usuarios', UsuarioController::class);
Route::apiResource('ordenes', OrdenController::class);
Route::apiResource('carritos', CarritoController::class);
Route::apiResource('item-carritos', ItemCarritoController::class);
Route::apiResource('item-ordenes', ItemOrdenController::class);
Route::apiResource('pagos', PagoController::class);