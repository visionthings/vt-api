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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')
                  ->constrained()
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->string('content_ar')->nullable();
            $table->string('content_en')->nullable();
            $table->string('content_type');
            $table->string('file_1')->nullable();
            $table->string('file_2')->nullable();
            $table->string('file_3')->nullable();
            $table->string('file_4')->nullable();
            $table->string('file_5')->nullable();
            $table->string('file_6')->nullable();
            $table->string('file_7')->nullable();
            $table->string('file_8')->nullable();
            $table->string('file_9')->nullable();
            $table->string('file_10')->nullable();
            $table->string('file_11')->nullable();
            $table->string('file_12')->nullable();
            $table->string('file_13')->nullable();
            $table->string('file_14')->nullable();
            $table->string('file_15')->nullable();
            $table->string('file_16')->nullable();
            $table->string('file_17')->nullable();
            $table->string('file_18')->nullable();
            $table->string('file_19')->nullable();
            $table->string('file_20')->nullable();
            $table->string('file_21')->nullable();
            $table->string('file_22')->nullable();
            $table->string('file_23')->nullable();
            $table->string('file_24')->nullable();
            $table->string('file_25')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
