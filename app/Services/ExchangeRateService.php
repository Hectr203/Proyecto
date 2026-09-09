<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ExchangeRateService
{
    /**
     * Obtiene el tipo de cambio de USD a MXN.
     * Si está en caché (Redis), lo retorna desde ahí para ahorrar llamadas a la API.
     */
    public function getUsdToMxnRate()
    {
        // Guardar en caché por 1 hora (3600 segundos) para no saturar la API
        return Cache::remember('usd_to_mxn_rate', 3600, function () {
            $apiUrl = env('EXCHANGE_RATE_API_URL', 'https://api.frankfurter.app/latest');
            
            try {
                $response = Http::get($apiUrl, [
                    'from' => 'USD',
                    'to' => 'MXN',
                ]);

                if ($response->successful()) {
                    return $response->json()['rates']['MXN'] ?? 20.00; // Valor seguro en caso de error de formato
                }
            } catch (\Exception $e) {
                // Si la API falla, retornamos un valor de contingencia
                return 20.00; 
            }

            return 20.00;
        });
    }
}
