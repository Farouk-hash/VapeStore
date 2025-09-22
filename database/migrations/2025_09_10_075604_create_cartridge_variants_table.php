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
        Schema::create('cartridge_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cartridge_id')->nullable()->references('id')->on('cartridge')->onDelete('set null');
            $table->string('resistance')->nullable();
            $table->string('vaping_style')->nullable(); //e.g., MTL, DL, RDL (common filter when buying).
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cartridge_variants');
    }
};
