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
        Schema::create('dealers', function (Blueprint $table) {
            $table->id();
            $table->string('dealership_name');
            $table->string('dealership_contact_person');
            $table->string('dealership_contact_number');
            $table->string('dealership_contact_email');
            $table->string('dealership_contact_address');
            $table->string('dealership_located_city');
            $table->string('dealership_located_state/province');
            $table->string('dealership_located_country');
            $table->string('dealership_located_pincode');
            $table->string('dealership_type');
            $table->string('dealership_business_type');
            $table->string('dealership_associated_brand');
            $table->string('dealership_sales_territory');
            $table->string('dealership_taxid');
            $table->string('dealership_licence_number');
            $table->string('dealership_registration_date');
            $table->string('dealership_licence_renewal_date');
            $table->string('dealership_status');
            $table->string('dealership_notes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dealers');
    }
};
