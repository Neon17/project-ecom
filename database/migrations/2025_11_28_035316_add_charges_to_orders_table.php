<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->bigInteger('tax_amount')->default(0)->after('status');
            $table->bigInteger('service_charge')->default(0)->after('tax_amount');
            $table->bigInteger('delivery_charge')->default(0)->after('service_charge');
            $table->bigInteger('total_amount')->nullable()->after('delivery_charge');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
