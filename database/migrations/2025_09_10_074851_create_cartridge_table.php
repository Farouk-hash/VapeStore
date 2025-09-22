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
        Schema::create('cartridge', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "Vaporesso XROS Cartridge", "SMOK Nord Cartridge"
            $table->enum('type', ['prefilled', 'refillable', 'disposable']);
            $table->decimal('capacity_ml', 5, 2); // e.g., 2.0, 3.5, 4.0
            $table->text('description')->nullable();
            
            $table->boolean('has_resistance')->default(true);
            $table->string('material'); //Helps customers who prefer non-plastic tanks.
            $table->string('coil_type')->nullable();//mesh, ceramic, cotton , Often specified in cartridge specs.

            $table->foreignId('category_id')->references('id')->on('device_categories')->onDelete('cascade');
            $table->foreignId('brand_id')->references('id')->on('device_brands')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cartridge');
    }
};
