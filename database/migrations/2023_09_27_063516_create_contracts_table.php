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
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('commercial_number');
            $table->string('address');
            $table->string('indoor_cameras');
            $table->string('outdoor_cameras');
            $table->string('storage_device');
            $table->string('period_of_record');
            $table->string('show_screens');
            $table->string('camera_type');
            $table->string('contract_date');
            $table->string('expiry_date');
            $table->string('contract_number')->unique();
            $table->string('price')->default(0);
            $table->string('vat')->default(0);
            $table->string('discount')->default(0);
            $table->string('total_price')->nullable();            
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
