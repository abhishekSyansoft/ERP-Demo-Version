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
        Schema::create('m_p_s', function (Blueprint $table) {
            $table->id();
            $table->string('product_id');
            $table->string('planned_quantity');
            $table->string('planned_start_date');
            $table->string('planned_end_date');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_p_s');
    }
};
