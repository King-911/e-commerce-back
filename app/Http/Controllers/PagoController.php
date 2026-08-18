<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function index()
    {
        return Pago::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'orden_id'    => 'required|string|size:36|exists:ordenes,id',
            'monto'       => 'required|numeric|min:0',
            'metodo_pago' => 'required|string',
            'estado'      => 'required|string',
        ]);

        $pago = Pago::create($validated);

        return response()->json($pago, 201);
    }

    public function show(Pago $pago)
    {
        return $pago;
    }

    public function update(Request $request, Pago $pago)
    {
        $validated = $request->validate([
            'orden_id'    => 'required|string|size:36|exists:ordenes,id',
            'monto'       => 'required|numeric|min:0',
            'metodo_pago' => 'required|string',
            'estado'      => 'required|string',
        ]);

        $pago->update($validated);

        return response()->json($pago);
    }

    public function destroy(Pago $pago)
    {
        $pago->delete();

        return response()->json(null, 204);
    }
}