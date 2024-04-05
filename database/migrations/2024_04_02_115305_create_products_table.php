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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('category_id');
            $table->string('product_name');
            $table->string('product_image');
            $table->string('product_description');
            $table->string('product_sku');
            $table->string('product_hsn');
            $table->string('product_uom');
            $table->string('product_weight');
            $table->string('product_volume');
            $table->string('product_taxrate');
            $table->string('product_price');
            $table->string('product_currency');
            $table->string('product_quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
