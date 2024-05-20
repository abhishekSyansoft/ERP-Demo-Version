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
        Schema::create('item_lists', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('part_number');
            $table->string('vehicle');
            $table->string('part_name');
            $table->decimal('unit_price', 10, 2); // Assuming unit price is a decimal with 10 digits in total and 2 digits after the decimal point
            $table->unsignedInteger('quantity');
            $table->string('pr_num');
            $table->string('item_des');
            $table->string('item_feature');
            $table->string('item_type');
            $table->decimal('total_price', 10, 2); // Assuming total price is a decimal with 10 digits in total and 2 digits after the decimal point
            $table->string('category');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_lists');
    }
};
