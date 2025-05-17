<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CepService
{
    /**
     * Busca os dados do CEP na API ViaCEP.
     *
     * @param  string  $cep
     * @return array
     *
     * @throws \Exception se CEP inválido
     */
    public function buscar(string $cep): array
    {
        $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");

        if ($response->failed() || isset($response['erro'])) {
            throw new \Exception('CEP inválido');
        }

        return $response->json();
    }
}
