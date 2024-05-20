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
        Schema::create('trackings', function (Blueprint $table) {
            $table->id();
            $table->string('inventory_id');
            $table->string('item_code');
            $table->string('description');
            $table->string('category')->nullable();
            $table->string('location')->nullable();
            $table->string('qty_on_hand')->nullable();
            $table->integer('min_stock_level')->nullable();
            $table->integer('max_stock_level');
            $table->integer('reorder_point');
            $table->double('unit_cost');
            $table->double('total_cost');
            $table->string('supplier')->nullable();
            $table->date('received_date');
            $table->integer('serial_number');
            $table->string('qrcode')->nullable();
            $table->string('barcode')->nullable();
            $table->string('condition')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('quality_control_detail')->nullable();
            $table->string('availability')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trackings');
    }
};
