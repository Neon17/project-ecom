<?php

namespace App\Services;

use Typesense\Client;
use Illuminate\Support\Facades\Log;

class TypesenseService
{
    protected $client;

    public function __construct()
    {
        try {
            $this->client = new Client([
                'api_key' => config('typesense.api_key', 'xyz'),
                'nodes' => [
                    [
                        'host' => config('typesense.host', 'localhost'),
                        'port' => config('typesense.port', '8108'),
                        'protocol' => config('typesense.protocol', 'http'),
                    ],
                ],
                'connection_timeout_seconds' => 2,
            ]);
        } catch (\Exception $e) {
            Log::error('Typesense client initialization failed: ' . $e->getMessage());
        }
    }

    public function getClient()
    {
        return $this->client;
    }

    public function isConnected()
    {
        try {
            $this->client->collections->retrieve();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function searchProducts($query, $options = [])
    {
        if (!$this->isConnected()) {
            throw new \Exception('Typesense not connected');
        }

        $searchParameters = array_merge([
            'q' => $query,
            'query_by' => 'name,description',
            'per_page' => 12,
        ], $options);

        return $this->client->collections['products']->documents->search($searchParameters);
    }
}