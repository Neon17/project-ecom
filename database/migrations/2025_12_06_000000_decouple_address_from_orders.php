<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Add new columns
        Schema::table('orders', function (Blueprint $table) {
            $table->string('shipping_country')->nullable();
            $table->string('shipping_state')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_street_address_1')->nullable();
            $table->string('shipping_street_address_2')->nullable();
        });

        // 2. Migrate data
        $orders = DB::table('orders')->whereNotNull('address_id')->get();
        foreach ($orders as $order) {
            $address = DB::table('addresses')->find($order->address_id);
            if ($address) {
                DB::table('orders')->where('id', $order->id)->update([
                    'shipping_country' => $address->country,
                    'shipping_state' => $address->state,
                    'shipping_city' => $address->city,
                    'shipping_street_address_1' => $address->street_address_1,
                    'shipping_street_address_2' => $address->street_address_2,
                ]);
            }
        }

        // 3. Drop foreign key and column
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['address_id']);
            $table->dropColumn('address_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('address_id')->nullable()->constrained('addresses')->onDelete('cascade');
        });

        // We cannot easily restore the address_id links unless we kept them or created new addresses.
        // For now, we just drop the new columns.
        
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'shipping_country',
                'shipping_state',
                'shipping_city',
                'shipping_street_address_1',
                'shipping_street_address_2',
            ]);
        });
    }
};
