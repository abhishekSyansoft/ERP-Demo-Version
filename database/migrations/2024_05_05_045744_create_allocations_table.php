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
        Schema::create('allocations', function (Blueprint $table) {
            $table->id();
            $table->string('inventory_id');
            $table->string('item_code');
            $table->string('description');
            $table->string('category')->nullable();
            $table->string('location')->nullable();
            $table->string('current_stock_level')->nullable();
            $table->integer('min_stock_level')->nullable();
            $table->integer('max_stock_level');
            $table->integer('reorder_point');
            $table->date('lead_time');
            $table->date('last_replenishment_date');
            $table->string('supplier')->nullable();
            $table->date('demand_forecast');
            $table->integer('sales_channels');
            $table->string('allocation_qty')->nullable();
            $table->string('alloation_date')->nullable();
            $table->string('demand_variability')->nullable();
            $table->date('safety_stock')->nullable();
            $table->string('order_qty')->nullable();
            $table->string('availability')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allocations');
    }
};
