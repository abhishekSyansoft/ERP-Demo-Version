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
        Schema::create('d_c_s', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('collaborator_id');
            $table->decimal('forecast_quantity');
            $table->decimal('collaboration_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('d_c_s');
    }
};
