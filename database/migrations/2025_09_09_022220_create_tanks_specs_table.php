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
        Schema::create('tanks_specs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tank_id')->references('id')->on('tanks')->cascadeOnDelete()->cascadeOnUpdate();
            
            $table->string('spec_key');   // Example: "Battery Capacity", "Resistance", "Tank Capacity"
            $table->string('spec_value'); // Example: "1500mAh", "0.6Ω", "5ml"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanks_specs');
    }
};
