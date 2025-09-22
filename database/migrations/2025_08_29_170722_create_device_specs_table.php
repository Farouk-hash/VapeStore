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
        Schema::create('device_specs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->constrained('devices')->cascadeOnDelete();
            
            $table->string('spec_key');   // Example: "Battery Capacity", "Resistance", "Tank Capacity"
            $table->string('spec_value'); // Example: "1500mAh", "0.6Ω", "5ml"
            $table->timestamps();
            $table->index(['spec_key']);
            $table->index(['device_id', 'spec_key']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_specs');
    }
};
