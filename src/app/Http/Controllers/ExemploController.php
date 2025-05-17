<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ExemploController extends Controller
{
    public function index()
    {
        $user = Auth::guard('token_query')->user();

        if (!$user) {
            return response()->json(['error' => 'Token inválido'], 401);
        }

        return response()->json([
            'message' => 'Usuário autenticado com sucesso!',
            'user' => $user,
        ]);
    }
}
