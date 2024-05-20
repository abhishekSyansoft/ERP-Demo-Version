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
        Schema::create('i_v_s', function (Blueprint $table) {
            $table->id();
            $table->string('inventory_id');
            $table->string('part_number');
            $table->string('unit_cost'); // Note: Appears twice in your list, I'll assume it's intentional
            $table->string('vehicle');
            $table->string('qty_on_hand'); // Assuming this should be added based on the provided list
            $table->string('total_cost');
            $table->string('valuation_method');
            $table->date('valuation_date');
            $table->string('inventory_value');
            $table->string('inventory_turnover');
            $table->string('stock_aging');
            $table->string('financial_metrics');
            $table->string('inventory_adjustments');
            $table->string('inventory_reserves');
            $table->string('inventory_analysis');
            $table->string('inventory_reports');
            $table->string('comparison_metrics');
            $table->string('compliance');
            $table->string('audit_trials');
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('i_v_s');
    }
};
