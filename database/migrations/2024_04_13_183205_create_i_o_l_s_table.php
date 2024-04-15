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
        Schema::create('i_o_l_s', function (Blueprint $table) {
            $table->id();
            $table->string('transport_id');
            $table->string('order_id');
            $table->date('received_date');
            $table->date('dispatched_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('i_o_l_s');
    }
};
