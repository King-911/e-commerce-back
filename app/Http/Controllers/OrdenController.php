<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use Illuminate\Http\Request;

class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Orden::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $orden = Orden::create($request->all());
        return response()->json($orden, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Orden $orden)
    {
        return $orden;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orden $orden)
    {
        $orden->update($request->all());
        return response()->json($orden, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orden $orden)
    {
        $orden->delete();
        return response()->json(null, 204);
    }
}