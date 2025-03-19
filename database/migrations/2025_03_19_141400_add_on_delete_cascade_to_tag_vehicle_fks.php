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
        Schema::table('tag_vehicle', function (Blueprint $table) {
            $table->dropForeign(['tag_id']);
            $table->dropForeign(['vehicle_id']);

            $table->foreignId('tag_id')->constrained()->onDelete('cascade');
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tag_vehicle', function (Blueprint $table) {
            $table->dropForeign(['tag_id']);
            $table->dropForeign(['vehicle_id']);

            $table->foreignId('tag_id')->constrained();
            $table->foreignId('vehicle_id')->constrained();
        });
    }
};
