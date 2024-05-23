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
        Schema::create('comp_lists', function (Blueprint $table) {
            $table->id();
            $table->string('pr_num');
            $table->string('rfq_num');
            $table->string('qut_num');
            $table->string('payment_terms');
            $table->string('lead_time');
            $table->date('qut_date');
            $table->integer('status');
            $table->integer('total_amount');
            $table->date('dos');
            $table->string('quotation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comp_lists');
    }
};
