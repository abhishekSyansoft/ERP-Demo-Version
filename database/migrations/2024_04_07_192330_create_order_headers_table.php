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
        Schema::create('order_headers', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('dealer_id');
            $table->string('order_date');
            $table->string('order_status');
            $table->string('total_amount');
            $table->string('sales_representative');
            $table->string('shipping_address');
            $table->string('billing_address');
            $table->string('payment_method');
            $table->string('payment_status');
            $table->string('sipping_method');
            $table->string('shipping_carrier');
            $table->string('shipping_tracking_number');
            $table->string('expected_delivery_date');
            $table->string('order_notes');
            $table->string('order_source');
            $table->string('item_count');
            $table->string('priority');
            $table->string('discount');
            $table->string('order_totoal');
            $table->string('return_rma');
            $table->string('comments');
            $table->string('attachments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_headers');
    }
};
