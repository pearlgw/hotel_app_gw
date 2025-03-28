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
        Schema::create('detail_reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reservations_id')->nullable();
            $table->unsignedBigInteger('bedrooms_id')->nullable();
            $table->integer('duration')->nullable();
            $table->bigInteger('total_price_per_room')->nullable();
            $table->dateTime('check_in')->nullable();
            $table->dateTime('check_out')->nullable();
            $table->boolean('status_reservasi')->nullable(false);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('reservations_id')->on('reservations')->references('id');
            $table->foreign('bedrooms_id')->on('bedrooms')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_reservations');
    }
};
