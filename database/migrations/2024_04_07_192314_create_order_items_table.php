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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('product_name');
            $table->string('product_id');
            $table->string('quantity');
            $table->string('unit_price');
            $table->string('total_price');
            $table->string('sku');
            $table->string('tax_rate');
            $table->string('tax_amount');
            $table->string('discount');
            $table->string('sub_total');
            $table->string('line_item_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
