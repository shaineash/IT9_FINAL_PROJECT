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
        Schema::table('rooms', function (Blueprint $table) {
            $table->string('room_number', 20)->change();
            $table->foreignId('room_category_id')->nullable()->constrained('room_categories')->nullOnDelete();
            $table->boolean('active')->default(true)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropForeign(['room_category_id']);
            $table->dropColumn('room_category_id');
            $table->dropColumn('active');
            $table->integer('room_number')->change();
        });
    }
};
