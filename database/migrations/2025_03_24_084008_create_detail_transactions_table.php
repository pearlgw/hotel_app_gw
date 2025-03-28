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
        Schema::create('detail_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transactions_id');
            $table->unsignedBigInteger('bedrooms_id');
            $table->integer('duration');
            $table->bigInteger('total_price_per_room');
            $table->dateTime('check_in');
            $table->dateTime('check_out');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('transactions_id')->on('transactions')->references('id');
            $table->foreign('bedrooms_id')->on('bedrooms')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transactions');
    }
};
