<?php

namespace App\Http\Controllers;

use App\Services\CepService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CepController extends Controller
{
    public function buscar(string $cep, CepService $cepService): JsonResponse
    {
        try {
            $dados = $cepService->buscar($cep);
            return response()->json($dados);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }
}
