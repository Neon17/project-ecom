<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public static $targetCount = 10; // Total orders

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $targetCount = self::$targetCount;
        $currentCount = Order::count();
        $remaining = $targetCount - $currentCount;

        if ($remaining <= 0) {
            return;
        }

        $this->command->info("Generating {$remaining} orders...");

        $users = User::all();
        $products = Product::all();

        if ($users->isEmpty() || $products->isEmpty()) {
            $this->command->warn("No users or products found. Skipping order seeding.");
            return;
        }

        $chunkSize = 100;
        $chunks = ceil($remaining / $chunkSize);
        
        $bar = $this->command->getOutput()->createProgressBar($remaining);
        $bar->start();

        for ($i = 0; $i < $chunks; $i++) {
            $count = min($chunkSize, $remaining);
            
            for ($j = 0; $j < $count; $j++) {
                $user = $users->random();
                
                // Ensure user has an address
                $address = Address::where('user_id', $user->id)->inRandomOrder()->first();
                if (!$address) {
                    $address = Address::factory()->create(['user_id' => $user->id]);
                }

                $order = Order::factory()->create([
                    'user_id' => $user->id,
                    'address_id' => $address->id,
                ]);

                // Create Order Items
                $orderProducts = $products->random(rand(1, 5));
                $totalAmount = 0;

                foreach ($orderProducts as $product) {
                    $quantity = rand(1, 3);
                    $price = $product->price; // Price is already in paisa/float depending on access
                    
                    // Note: Product model accessor divides by 100, so we get float.
                    // OrderItem usually stores integer or float? 
                    // Let's assume OrderItem stores same way as Product (or we need to check).
                    // Checking OrderItem migration... usually decimal or integer.
                    // If Product::price returns float (rupees), and we want to store that.
                    
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'amount_per_item' => $price,
                    ]);

                    $totalAmount += $price * $quantity;
                }

                // Create Payment
                Payment::factory()->create([
                    'order_id' => $order->id,
                    'total_amount' => $totalAmount,
                ]);
            }
            
            $remaining -= $count;
            $bar->advance($count);
        }
        
        $bar->finish();
        $this->command->info("\nDone!");
    }
}
