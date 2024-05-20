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
        Schema::create('parts', function (Blueprint $table) {
            $table->id();
            $table->string('part_number');
            $table->string('serial_number');
            $table->string('part_name');
            $table->string('vehicle');
            $table->string('part_description');
            $table->string('notes');
            $table->string('warranty_description');
            $table->string('location');
            $table->string('shelf_number');
            $table->string('condition');
            $table->string('unit_cost');
            $table->string('qty_on_hand');
            $table->string('min_stock_level');
            $table->string('max_stock_level');
            $table->string('compatability');
            $table->string('barcode');
            $table->string('image');
            $table->string('supplier_id');
            $table->string('lead_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parts');
    }
};
