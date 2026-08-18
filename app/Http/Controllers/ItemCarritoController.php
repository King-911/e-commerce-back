<?php

namespace App\Http\Controllers;

use App\Models\ItemCarrito;
use Illuminate\Http\Request;

class ItemCarritoController extends Controller
{
    public function index()
    {
        return ItemCarrito::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'carrito_id'      => 'required|string|size:36|exists:carritos,id',
            'producto_id'     => 'required|string|size:36|exists:productos,id',
            'cantidad'        => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
        ]);

        $itemCarrito = ItemCarrito::create($validated);

        return response()->json($itemCarrito, 201);
    }

    public function show(ItemCarrito $itemCarrito)
    {
        return $itemCarrito;
    }

    public function update(Request $request, ItemCarrito $itemCarrito)
    {
        $validated = $request->validate([
            'carrito_id'      => 'required|string|size:36|exists:carritos,id',
            'producto_id'     => 'required|string|size:36|exists:productos,id',
            'cantidad'        => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
        ]);

        $itemCarrito->update($validated);

        return response()->json($itemCarrito);
    }

    public function destroy(ItemCarrito $itemCarrito)
    {
        $itemCarrito->delete();

        return response()->json(null, 204);
    }
}