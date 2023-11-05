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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->string('manage_pages')->nullable();
            $table->string('manage_contracts')->nullable();
            $table->string('create_contract')->nullable();
            $table->string('manage_promocodes')->nullable();
            $table->string('manage_members')->nullable();
            $table->string('view_reports')->nullable();
            $table->string('view_mail')->nullable();
            $table->string('profile_pic')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('company_type')->nullable();
            $table->string('commercial_number')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('city')->nullable();
            $table->string('building_number')->nullable();
            $table->string('street_name')->nullable();
            $table->string('second_number')->nullable();
            $table->string('district')->nullable();
            $table->string('zip_code')->nullable();
            $table->timestamp('email_verified_at') ;
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
