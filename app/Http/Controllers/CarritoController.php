<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function index()
    {
        return Carrito::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'usuario_id' => 'required|string|size:36|exists:usuarios,id',
        ]);

        $carrito = Carrito::create($validated);

        return response()->json($carrito, 201);
    }

    public function show(Carrito $carrito)
    {
        return $carrito;
    }

    public function update(Request $request, Carrito $carrito)
    {
        $validated = $request->validate([
            'usuario_id' => 'required|string|size:36|exists:usuarios,id',
        ]);

        $carrito->update($validated);

        return response()->json($carrito);
    }

    public function destroy(Carrito $carrito)
    {
        $carrito->delete();

        return response()->json(null, 204);
    }
}