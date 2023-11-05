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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('company_type');
            $table->string('commercial_number');
            $table->string('tax_number');
            $table->string('city');
            $table->string('building_number');
            $table->string('street_name');
            $table->string('second_number');
            $table->string('district');
            $table->string('zip_code');
            $table->string('indoor_cameras');
            $table->string('outdoor_cameras');
            $table->string('storage_device');
            $table->string('period_of_record');
            $table->string('show_screens');
            $table->string('camera_type');
            $table->string('contract_date');
            $table->string('expiry_date');
            $table->string('contract_number')->unique();
            $table->string('paid_amount')->nullable();
            $table->string('discount')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
