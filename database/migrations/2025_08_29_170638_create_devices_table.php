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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Example: Nord 4, Xros 3
            $table->string('release_year')->nullable();
            $table->string('sku')->unique()->nullable();
            $table->boolean('is_available')->default(true);
            $table->longText('description')->nullable();
            $table->foreignId('brand_id')->constrained('device_brands')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('device_categories')->cascadeOnDelete();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
