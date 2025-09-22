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
        Schema::create('coil_series', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "Z-Coils", "PnP Coils", "GTX Coils"
            $table->text('description')->nullable();
            $table->foreignId('brand_id')->references('id')->on('device_brands')->onDelete('cascade');
            $table->foreignId('category_id')->references('id')->on('device_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coil_series');
    }
};
