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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('vin');
            $table->string('model');
            $table->date('year');
            $table->string('color');
            $table->string('trim');
            $table->string('mileage');
            $table->string('condition');
            $table->string('price');
            $table->string('location')->nullable();
            $table->string('status');
            $table->string('salesperson')->nullable();
            $table->string('image')->nullable();
            $table->string('history');
            $table->string('barcode');
            $table->string('qrcode');
            $table->string('features')->nullable();
            $table->string('vehicles_identification_documents')->nullable();
            $table->string('availability')->nullable();
            $table->string('warranty_information')->nullable();
            $table->string('financial_information')->nullable();
            $table->string('trade_in_information')->nullable();
            $table->string('min_stock_level')->nullable();
            $table->string('max_stock_level')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
