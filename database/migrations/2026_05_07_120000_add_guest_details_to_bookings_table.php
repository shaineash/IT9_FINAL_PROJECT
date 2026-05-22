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
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('guest_name', 150)->after('room_id')->nullable();
            $table->string('guest_email', 150)->after('guest_name')->nullable();
            $table->string('contact_number', 40)->after('guest_email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['guest_name', 'guest_email', 'contact_number']);
        });
    }
};
