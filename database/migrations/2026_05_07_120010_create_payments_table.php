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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('payment_method', ['card', 'paypal', 'bank_transfer'])->default('card');
            $table->string('cardholder_name', 150);
            $table->string('card_brand')->nullable();
            $table->string('card_last4', 4)->nullable();
            $table->string('billing_address', 255);
            $table->decimal('amount', 10, 2);
            $table->enum('status', ['pending', 'completed', 'failed'])->default('completed');
            $table->string('transaction_reference')->nullable();
            $table->timestamps();

            $table->index(['booking_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
