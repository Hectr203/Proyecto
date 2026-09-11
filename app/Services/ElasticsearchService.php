<?php

namespace App\Services;

use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Client;

class ElasticsearchService
{
    protected Client $client;

    public function __construct()
    {
        $this->client = ClientBuilder::create()
            ->setHosts([env('ELASTICSEARCH_HOST', 'http://localhost:9200')])
            ->build();
    }

    public function indexProduct($product)
    {
        $params = [
            'index' => 'products',
            'id'    => $product->id,
            'body'  => [
                'nombre' => $product->nombre,
                'descripcion_corta' => $product->descripcion_corta,
                'sku' => $product->sku,
                'category_id' => $product->category_id,
                'activo' => $product->activo,
            ]
        ];

        try {
            return $this->client->index($params);
        } catch (\Exception $e) {
            // Log or ignore on local dev if elastic is down
        }
    }

    public function deleteProduct($product)
    {
        $params = [
            'index' => 'products',
            'id'    => $product->id,
        ];

        try {
            return $this->client->delete($params);
        } catch (\Exception $e) {
            // Ignore if not found
        }
    }

    public function searchFuzzy($queryText)
    {
        $params = [
            'index' => 'products',
            'body'  => [
                'query' => [
                    'bool' => [
                        'must' => [
                            [
                                'match' => [
                                    'nombre' => [
                                        'query' => $queryText,
                                        'fuzziness' => 'AUTO'
                                    ]
                                ]
                            ]
                        ],
                        'filter' => [
                            ['term' => ['activo' => 1]]
                        ]
                    ]
                ]
            ]
        ];

        try {
            $response = $this->client->search($params);
            $hits = $response['hits']['hits'] ?? [];
            return collect($hits)->pluck('_id')->toArray();
        } catch (\Exception $e) {
            \Log::error('Elasticsearch search error: ' . $e->getMessage());
            return null; // Return null on error to fallback to normal search
        }
    }
}
