<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Services\TypesenseService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ImportProductsToTypesense extends Command
{
    protected $signature = 'typesense:import';
    protected $description = 'Import all products into Typesense';

    public function handle()
    {
        $this->info('Starting Typesense import...');

        try {
            $typesense = app(TypesenseService::class); // Use dependency injection
            $client = $typesense->getClient();

            // Test connection first
            $this->info('Testing Typesense connection...');
            $health = $client->health->retrieve();
            $this->info('Typesense health: ' . ($health['ok'] ? 'OK' : 'Not OK'));

        } catch (\Exception $e) {
            $this->error('Failed to connect to Typesense: ' . $e->getMessage());
            $this->error('Please check your Typesense server and configuration.');
            return 1;
        }

        // Define schema
        $schema = [
            'name' => 'products',
            'fields' => [
                ['name' => 'id', 'type' => 'string'],
                ['name' => 'name', 'type' => 'string'],
                ['name' => 'description', 'type' => 'string'],
                ['name' => 'price', 'type' => 'int32'],
                ['name' => 'category_ids', 'type' => 'int32[]'],
                ['name' => 'image', 'type' => 'string', 'optional' => true],
                ['name' => 'slug', 'type' => 'string'],
                ['name' => 'status', 'type' => 'string'], // Added status for filtering
                ['name' => 'created_at', 'type' => 'int64'], // Added for sorting
            ],
            'default_sorting_field' => 'created_at', // Better default than price
        ];

        // Delete existing collection if it exists
        try {
            $this->info('Deleting existing collection...');
            $client->collections['products']->delete();
            $this->info('Old collection deleted.');
        } catch (\Exception $e) {
            $this->info('No existing collection to delete.');
        }

        // Create new collection
        try {
            $this->info('Creating new collection...');
            $client->collections->create($schema);
            $this->info('Collection created successfully.');
        } catch (\Exception $e) {
            $this->error('Failed to create collection: ' . $e->getMessage());
            return 1;
        }

        // Import products
        $this->info('Fetching products from database...');
        $products = Product::with('categories')->get();
        
        $this->info("Found {$products->count()} products to import.");

        $documents = [];
        $batchSize = 1000; // Process in batches to avoid memory issues
        $importedCount = 0;

        $bar = $this->output->createProgressBar($products->count());

        foreach ($products as $product) {
            $document = [
                'id' => (string) $product->id,
                'name' => $product->name,
                'description' => $product->description ?? '',
                'price' => (int) $product->getRawOriginal('price'),
                'category_ids' => $product->categories->pluck('id')->map(fn($id) => (int)$id)->toArray(),
                'image' => $product->image ?? '',
                'slug' => $product->slug,
                'status' => $product->status ?? 'active',
                'created_at' => $product->created_at->timestamp,
            ];

            $documents[] = $document;

            // Import in batches
            if (count($documents) >= $batchSize) {
                $this->importBatch($client, $documents, $importedCount);
                $documents = []; // Clear the batch
            }

            $bar->advance();
        }

        // Import any remaining documents
        if (!empty($documents)) {
            $this->importBatch($client, $documents, $importedCount);
        }

        $bar->finish();
        $this->newLine();
        $this->info("Successfully imported {$importedCount} products to Typesense.");

        return 0;
    }

    private function importBatch($client, &$documents, &$importedCount)
    {
        try {
            $result = $client->collections['products']->documents->import($documents, ['action' => 'upsert']);
            
            // Count successful imports
            $successful = array_filter($result, function($item) {
                return $item['success'] ?? false;
            });
            
            $importedCount += count($successful);
            
            // Log failures
            $failures = array_filter($result, function($item) {
                return !($item['success'] ?? false);
            });
            
            if (!empty($failures)) {
                $this->warn('Some documents failed to import: ' . json_encode($failures));
            }
            
        } catch (\Exception $e) {
            $this->error('Batch import failed: ' . $e->getMessage());
        }
    }
}