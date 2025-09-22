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
        Schema::create('group_inventories_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->references('id')->on('group_inventories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('devices_id')->nullable()->references('id')->on('device_inventories')->cascadeOnUpdate();
            $table->foreignId('liquid_id')->nullable()->references('id')->on('liquid_inventory')->cascadeOnUpdate();
            $table->integer('quantity');
            $table->string('source'); // Liquids , Coils , Cartridges , .... ; 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_inventories_details');
    }
};
