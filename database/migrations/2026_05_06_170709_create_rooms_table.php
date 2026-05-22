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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('type', 50)->comment('Standard, Deluxe, Suite, etc.');
            $table->decimal('price_per_night', 10, 2);
            $table->integer('capacity')->default(2);
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->enum('status', ['available', 'maintenance', 'booked'])->default('available');
            $table->integer('room_number')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
