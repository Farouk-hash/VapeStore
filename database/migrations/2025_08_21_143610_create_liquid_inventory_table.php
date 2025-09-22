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
        Schema::create('liquid_inventory', function (Blueprint $table) {
            $table->id();
            $table->integer('stock_received');
            $table->timestamp('received_at');

            $table->decimal('base_price');
            $table->timestamp('displayed_at');
            $table->boolean('is_active')->default(true);

            $table->foreignId('liquid_nic_strength_id')->references('id')->on('liquid_nic_strength')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liquid_inventory');
    }
};
