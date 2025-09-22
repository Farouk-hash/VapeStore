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
        Schema::create('coils', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "Z-Coil 0.3Ω", "PnP Coil 0.6Ω"
            $table->decimal('resistance', 5, 2); // e.g., 0.3, 0.8, 1.2
            $table->string('wattage_range'); // e.g., "30-40W", "12-15W"
            $table->enum('vaping_style', ['mtl', 'rdl', 'dl']);
            $table->text('description')->nullable();
            $table->foreignId('coil_series_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coils');
    }
};
