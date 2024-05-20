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
        Schema::create('w_m_s', function (Blueprint $table) {
            $table->id();
            $table->string('warehouse_id');
            $table->string('warehouse_name');
            $table->string('warehouse_manager');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('pincode');
            $table->string('capacity');
            $table->string('layout');
            $table->string('storage_zone');
            $table->string('shelf_number');
            $table->string('inventory_allocation');
            $table->string('inventory_movement');
            $table->string('inventory_levels');
            $table->string('picking_and_packing');
            $table->string('loading_and_unloading');
            $table->string('safety_and_security');
            $table->string('maintenance_and_sheduling');
            $table->string('temprature_and_climate_control');
            $table->string('emergency_procedures');
            $table->string('inventory_audits');
            $table->string('documents_and_records');
            $table->string('integration_with_ims');
            $table->string('barcode');
            $table->string('qrcode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('w_m_s');
    }
};
