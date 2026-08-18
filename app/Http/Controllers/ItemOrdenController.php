<?php

namespace App\Http\Controllers;

use App\Models\ItemOrden;
use Illuminate\Http\Request;

class ItemOrdenController extends Controller
{
    public function index()
    {
        return ItemOrden::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'orden_id'        => 'required|string|size:36|exists:ordenes,id',
            'producto_id'     => 'required|string|size:36|exists:productos,id',
            'cantidad'        => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
        ]);

        $itemOrden = ItemOrden::create($validated);

        return response()->json($itemOrden, 201);
    }

    public function show(ItemOrden $itemOrden)
    {
        return $itemOrden;
    }

    public function update(Request $request, ItemOrden $itemOrden)
    {
        $validated = $request->validate([
            'orden_id'        => 'required|string|size:36|exists:ordenes,id',
            'producto_id'     => 'required|string|size:36|exists:productos,id',
            'cantidad'        => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
        ]);

        $itemOrden->update($validated);

        return response()->json($itemOrden);
    }

    public function destroy(ItemOrden $itemOrden)
    {
        $itemOrden->delete();

        return response()->json(null, 204);
    }
}