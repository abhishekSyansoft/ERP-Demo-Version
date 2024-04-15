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
        Schema::create('s_o_p_s', function (Blueprint $table) {
            $table->id();
            $table->integer('forecast_id');
            $table->integer('production_plan_id');
            $table->decimal('sales_target');
            $table->decimal('production_target');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('s_o_p_s');
    }
};
