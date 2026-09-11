<?php

namespace App\Core\Catalog\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ExchangeRateService
{
    /**
     * Obtiene el tipo de cambio USD a MXN.
     * Utiliza Redis (a través de Cache) para no saturar la API.
     */
    public static function getUsdToMxnRate(): float
    {
        return Cache::remember('usd_mxn_rate', now()->addHours(1), function () {
            try {
                $response = Http::timeout(5)->get('https://open.er-api.com/v6/latest/USD');
                
                if ($response->successful() && isset($response->json()['rates']['MXN'])) {
                    return (float) $response->json()['rates']['MXN'];
                }
                
                Log::warning('Respuesta no exitosa al consultar el API de tipo de cambio.');
            } catch (\Exception $e) {
                Log::error('Excepción al consultar el API de tipo de cambio: ' . $e->getMessage());
            }

            // Fallback rate si la API falla
            return 20.00;
        });
    }
}
