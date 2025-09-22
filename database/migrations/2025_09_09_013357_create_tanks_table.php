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
        Schema::create('tanks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('vaping_style');
            $table->string('release_year');
            $table->foreignId('brand_id')->references('id')->on('device_brands')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('category_id')->constrained('device_categories')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanks');
    }
};
