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
        Schema::create('s_q_n_s', function (Blueprint $table) {
            $table->id();
            $table->string('pr_num');
            $table->string('rfq_num');
            $table->string('qut_num');
            $table->string('total_amount');
            $table->string('visibility');
            $table->string('supplier_id');
            $table->string('item_id');
            $table->string('price');
            $table->string('valid_until');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('s_q_n_s');
    }
};
