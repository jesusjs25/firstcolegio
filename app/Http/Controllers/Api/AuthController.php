<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validamos que lleguen los datos
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Intentamos autenticar
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Autenticación fallida: Credenciales incorrectas.'
            ], 401);
        }

        // 3. Si tiene éxito, buscamos al usuario y generamos un Token
        $user = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Autenticación exitosa',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => [
                'name' => $user->name,
                'role' => $user->role // Usamos el campo role que tienes en tu migración
            ]
        ]);
    }

    public function logout(Request $request) {
        // Si no hay usuario autenticado, retornamos error 401 (No autorizado)
        // o simplemente un 200 para que la app igual borre el token local
        $user = $request->user();
        
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 401);
        }

        $user->currentAccessToken()->delete();

        return response()->json(['message' => 'Sesión cerrada'], 200);
    }
}