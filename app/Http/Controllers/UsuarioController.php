<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        return Usuario::all();
    }

    // REGISTRATION / CREATE USER
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|min:6',
            'rol' => 'nullable|string'
        ]);

        $usuario = Usuario::create([
            'email' => $validated['email'],
            'password_hash' => Hash::make($validated['password']), // Securely hash password
            'rol' => $validated['rol'] ?? 'cliente'
        ]);

        return response()->json($usuario, 201);
    }

    // LOGIN ENDPOINT
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $usuario = Usuario::where('email', $request->email)->first();

        // Check if user exists and password matches password_hash
        if (!$usuario || !Hash::check($request->password, $usuario->password_hash)) {
            return response()->json([
                'message' => 'Credenciales incorrectas.'
            ], 401);
        }

        // Return user data (or append Sanction token if using API tokens)
        return response()->json([
            'message' => 'Login successful',
            'user' => $usuario
        ], 200);
    }

    public function show(Usuario $usuario)
    {
        return $usuario;
    }

    public function update(Request $request, Usuario $usuario)
    {
        if ($request->has('password')) {
            $request->merge(['password_hash' => Hash::make($request->password)]);
        }

        $usuario->update($request->all());
        return response()->json($usuario, 200);
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return response()->json(null, 204);
    }
}