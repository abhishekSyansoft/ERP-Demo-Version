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
        Schema::create('gate_entry_models', function (Blueprint $table) {
            $table->id();
            $table->string('dnn')->nullable(); // Delivery Note Number
            $table->string('supplier')->nullable(); // Delivery Note Number
            $table->date('delivery_date')->nullable(); // Delivery Date
            $table->time('delivery_time')->nullable(); // Delivery Time
            $table->string('vehicle_number')->nullable(); // Vehicle Number
            $table->string('driver_name')->nullable(); // Driver's Name
            $table->string('driver_contact')->nullable(); // Driver's Contact
            $table->string('invoice_number')->nullable(); // Purchase Order Number
            $table->date('invoice_date')->nullable(); // Order Date
            $table->string('po_number')->nullable(); // Purchase Order Number
            $table->date('order_date')->nullable(); // Order Date
            $table->string('item_id')->nullable(); // Item ID
            $table->string('item_name')->nullable(); // Item Name
            $table->integer('quantity_delivered')->nullable(); // Quantity Delivered
            $table->integer('ordered_qty')->nullable(); // Passed Quantity
            $table->integer('passed_qty')->nullable(); // Passed Quantity
            $table->integer('failed_qty')->nullable(); // Failed Quantity
            $table->string('packaging_condition')->nullable(); // Packaging Condition
            $table->string('labeling')->nullable(); // Labeling
            $table->text('visual_inspection_notes')->nullable(); // Visual Inspection Notes
            $table->string('photo_evidence')->nullable(); // Photo Evidence
            $table->string('inspector_name')->nullable(); // Inspector Name
            $table->string('inspector_id_signature')->nullable(); // Inspector ID/Signature
            $table->timestamps(); // Created at and Updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gate_entry_models');
    }
};
