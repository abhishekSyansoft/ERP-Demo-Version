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
        Schema::create('create_r_f_q_s', function (Blueprint $table) {
            $table->id();
            $table->string('pr_num');
            $table->string('rfq_num');
            $table->integer('rfq_status');
            $table->integer('send');
            $table->date('date');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('create_r_f_q_s');
    }
};
