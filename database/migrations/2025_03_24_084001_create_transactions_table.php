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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('code_transaction');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('order_id');
            $table->bigInteger('total_price')->nullable();
            $table->bigInteger('pay_money')->nullable();
            $table->bigInteger('refund_money')->nullable();
            $table->enum('status',['paid', 'done'])->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('order_id')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
