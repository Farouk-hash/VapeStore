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
        Schema::create('device_brands', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Example: SMOK, Vaporesso
            $table->string('website')->nullable();
            $table->longText('description')->nullable();
            $table->string('country');
            $table->string('logo')->nullable(); // brand logo
            $table->boolean('premium')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_brands');
    }
};
