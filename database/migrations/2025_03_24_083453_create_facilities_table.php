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
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bedrooms_id');
            $table->boolean('wifi')->nullable();
            $table->boolean('elektronik')->nullable();
            $table->boolean('swimming_pool')->nullable();
            $table->boolean('gym')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('bedrooms_id')->on('bedrooms')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facilities');
    }
};
